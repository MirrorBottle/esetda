<?php

namespace App\Http\Controllers;

use App\LetterNumber;
use Illuminate\Http\Request;
use App\LetterNumberUsed;
use App\LetterNumberUsedBundle;
use Carbon\Carbon;
use Shivella\Bitly\Facade\Bitly;

class LetterNumberUsedController extends Controller
{
    public function index()
    {
        $letter_number_useds = LetterNumberUsed::orderBy('order', 'desc')->get();
        if (auth()->user()->username == 'fahmi') {
            $letter_number_useds = LetterNumberUsed::onlyTrashed()->orderBy('order', 'desc')->get();
        }

        return view('letter_number.used.index', compact('letter_number_useds'));
    }

    public function create()
    {
        return view('letter_number.used.create');
    }

    public function edit($id)
    {
        $letter_number_used = LetterNumberUsed::find($id);

        return view('letter_number.used.edit', compact('letter_number_used'));
    }

    public function store(Request $request)
    {
        // hapus data nomor urut sudah pernah di pakai sebelumnya
        $check_existed = LetterNumberUsed::where('order', $request->order)->withTrashed()->first();
        if ($check_existed !== null) {
            // hapus permanen data lama
            $check_existed->forceDelete();
        }

        $input = $request->all();
        $used = LetterNumberUsed::create($input);
        if (!$used) {
            return redirect('/arsip/penomoran')->with('error', 'Gagal menambah data penomoran baru');
        }

        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $extension  = $file->getClientOriginalExtension();
            $name       = 'number_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

            $check = in_array(strtolower($extension), $allowed);
            if ($check) {
                $file->move(public_path('storage'), $name);
                $used->update(['attachment' => $name]);
            }
        }

        return redirect('/arsip/penomoran')->with('success', 'Berhasil menambah data penomoran baru');
    }

    public function update(Request $request, $id)
    {
        // check wrong number
        if ($request->start > $request->end) {
            return back()->with('error', 'Nomor awal lebih besar daripada nomor akhir');
        }

        $letter_number_used = LetterNumberUsed::findOrFail($id);
        $used = $letter_number_used->update($request->all());
        if (!$used) {
            return back()->with('error', 'Gagal memperbarui data penomoran!');
        }

        if ($request->hasFile('attachment'))
        {
            $allowed    = ['pdf', 'jpg', 'jpeg', 'png'];
            $file       = $request->file('attachment');
            $extension  = $file->getClientOriginalExtension();
            $name       = 'nomor_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;

            $check = in_array(strtolower($extension), $allowed);
            if ($check) {
                $file->move(public_path('storage'), $name);
                $letter_number_used->update(['attachment' => $name]);
            }
        }

        // check attachments status
        if ($request->uploaded_file == 'removed') {
            $letter_number_used->update(['attachment' => null]);
        }

        return redirect('/arsip/penomoran')->with('success', 'Berhasil memperbarui data penomoran');
    }

    public function destroy($id)
    {
        $letter_number_used = LetterNumberUsed::findOrFail($id);
        $letter_number_used->delete();

        return back()->with('success', 'Berhasil menghapus data penomoran');
    }

    public function restore($id)
    {
        $letter_number_used = LetterNumberUsed::onlyTrashed()->findOrFail($id);
        $letter_number_used->restore();

        return back()->with('success', 'Berhasil mengembalikan data penomoran');
    }

    public function forceDelete($id)
    {
        $letter_number_used = LetterNumberUsed::onlyTrashed()->findOrFail($id);
        $letter_number_used->forceDelete();

        return back()->with('success', 'Berhasil menghapus permanen data penomoran');
    }

    public function send(Request $request)
    {
        if ($request->list_id === null || $request->list_id === '') {
            return back()->with('error', 'Belum ada data terpilih');
        }

        $bundle = LetterNumberUsedBundle::create([
            'list_id' => $request->list_id
        ]);

        $short_link = $this->generateShortLink($bundle->id);
        $bundle->update(['link' => $short_link]);

        return back()->with('info', $short_link);
    }

    public function generateNumberOrder($date)
    {
        $date = Carbon::parse($date);
        $letter_number = LetterNumber::where('month_year', $date->format('Y-m-d'))->first();

        // jika data master nomor tidak ada
        if ($letter_number == null) {
            return response()->json(['type' => 'error', 'id' => null, 'order' => null]);
        }

        // jika belum pernah di pakai mulai dari nomer awal
        if ($letter_number->useds()->withTrashed()->count() == 0) {
            return response()->json(['type' => 'success', 'id' => $letter_number->id, 'order' => $letter_number->start]);
        }

        // jika pernah di hapus maka ambil dulu atau ambil data terakhir
        $latest_used = $letter_number->useds()->onlyTrashed()->orderBy('order', 'asc')->first();
        if ($latest_used !== null) {
            $latest_number = $latest_used->order;
        } else {
            $latest_used   = $letter_number->useds()->orderBy('order', 'desc')->first();
            $latest_number = $latest_used->order + 1;
        }

        // jika nomer sudah sampai ujung
        if ($latest_number > $letter_number->end) {
            return response()->json(['type' => 'error', 'id' => null, 'order' => null]);
        }

        $format = ['type' => 'success', 'id' => $letter_number->id, 'order' => $latest_number];

        return response()->json($format);
    }

    private function generateShortLink($bundle_id)
    {
        $linktree = url('linktree/penomoran/'. $bundle_id);

        return Bitly::getUrl($linktree);
    }
}
