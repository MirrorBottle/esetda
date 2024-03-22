<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\DispositionAdmin;
use App\Forward;
use App\Http\Requests\VisitorRequest;
use App\Inbox;
use App\Receiver;
use App\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visitors = Visitor::orderBy('id', 'desc')->get();
        $receivers = Receiver::limit(7)->get(['id', 'name']);

        return view('visitor.index', compact('visitors', 'receivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $receivers = Receiver::limit(7)->get(['id', 'name']);

        return view('visitor.create', compact('receivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitorRequest $request)
    {
        $input = $request->except('attachment');
        $input['unique_key'] = unique_key();

        $visitor = Visitor::create($input);

        if ($request->hasFile('attachment')) {
            $allowedfileExtension = ['doc', 'docx', 'pdf', 'jpg', 'jpeg', 'png'];
            $file = $request->file('attachment');
            $title = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $name = 'visitor_' . date('d_m_Y') . '_' . str_random(10) . '.' . $extension;
            $size = $file->getSize();
            $check = in_array(strtolower($extension), $allowedfileExtension);
            if (!$check) {
                return back()->with('error', 'Ekstensi file yang diijinkan hanya dokumen word, pdf dan gambar saja.');
            }

            $attachment = new Attachment([
                'user_id' => 1,
                'title' => $title,
                'name' => $name,
                'ext' => $extension,
                'size' => $size,
                'order' => 1
            ]);

            $file->move(public_path('storage'), $name);
            $visitor->attachment()->save($attachment);
        }

        return back()->with('custom_message', $visitor->unique_key);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function show(Visitor $visitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Visitor $visitor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Visitor $visitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Visitor  $visitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Visitor $visitor)
    {
        //
    }

    /**
     * Forward visitor data to tupim.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forward(Request $request)
    {
        try {
            $visitor = Visitor::findOrFail($request->visitor_id);
            $visitor->update([
                'status' => 'P',
                'receiver_id' => $request->receiver_id,
                'no_agenda' => $request->no_agenda,
                'property' => $request->property,
            ]);

            // add visitor data to tupim - first
            $inbox = Inbox::create([
                'biro_id' => 1,
                'user_id' => auth()->user()->id,
                'no' => $visitor->letter_no ?? '-',
                'title' => $visitor->letter_title,
                'date' => $visitor->created_at,
                'date_entry' => date('Y-m-d'),
                'category_id' => 3, // Lain-lain
                'receiver_id' => $visitor->receiver_id,
                'sender' => $visitor->institution,
                'description' => $visitor->description,
                'is_attachment' => 1,
                'visitor_id' => $visitor->id,
                'unique_key' => $visitor->unique_key,
            ]);

            // duplicate attachment from visitor
            $attachment = new Attachment([
                'user_id' => auth()->user()->id,
                'title' => $visitor->attachment->title,
                'name' => $visitor->attachment->name,
                'ext' => $visitor->attachment->ext,
                'size' => $visitor->attachment->size,
                'order' => 1
            ]);

            $inbox->attachments()->saveMany([$attachment]);

            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();

            return back()->with('error', 'Terjadi Kesalahan. Gagal meneruskan surat ke tujuan terpilih');
        }

        return back()->with('success', 'Berhasil meneruskan surat ke tujuan terpilih');
    }

    /**
     * Cancel visitor letter.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function invalid(Request $request)
    {
        $visitor = Visitor::findOrFail($request->id);
        $visitor->update([
            'status' => 'T',
            'invalid_note' => $request->invalid_note,
        ]);

        return back()->with('success', 'Berhasil mengirim penolakan surat');
    }

    /**
     * Count visitor data
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function count()
    {
        $total = Visitor::where('status', 'B')->count();

        return response()->json(['total' => $total]);
    }

    /**
     * Check diposition status per unique code
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function check(Request $request)
    {
        $kode = null;
        $disposisi = null;
        if ($request->has('kode')) {
            $kode = $request->kode;
            $visitor = Visitor::where('unique_key', $request->kode)->first();
            if ($visitor === null) {
                return redirect('/cek-surat')->with('code_wrong', 'Data dengan kode resi ' . $request->kode . ' tidak ditemukan.');
            }
            $disposisi = $visitor->disposition_admin;
        }

        return view('visitor.check', compact('disposisi', 'kode'));
    }
}
