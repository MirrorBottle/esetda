<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SuratKeluarRequest;
use App\Biro;
use App\Outbox;
use App\Category;
use App\Attachment;
use App\ArchiveInfo;
use App\Receiver;

class OutboxController extends Controller
{
    public function index(Request $request)
    {
        $biro_id = auth()->user()->biro_id;
        $biros   = Biro::where('id', '!=', $biro_id)->pluck('name', 'id');
        $outboxes = Outbox::where('biro_id', $biro_id)->orderBy('id', 'desc')->limit(50)->get();

        return view('outbox.index', compact('outboxes', 'biros'));
    }

    public function detail($id)
    {
        $outbox = Outbox::withTrashed()->findOrFail($id);
        $data = [
            'no_surat' => $outbox->no,
            'title' => $outbox->title,
            'date' => $outbox->date_formatted,
            'date_entry' => $outbox->date_entry_formatted,
            'sender' => $outbox->biro->name,
            'category' => $outbox->category->name,
            'receiver' => $outbox->receiver->name,
            'description' => $outbox->description ?? '-',
            'is_attachment' => $outbox->is_attachment == 0 ? false : true,
            'attachments' => $outbox->attachments,
            'no_agenda' => '-',
            'sifat' => '-',
            'forward_note' => $outbox->forwards[0]->note ?? '-',
        ];

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $receivers  = $this->customReceiver();
        $date       = to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1);

        return view('outbox.create', compact('categories', 'receivers', 'date'));
    }

    public function store(SuratKeluarRequest $request)
    {
        $loop = 1;
        $input = $request->all();
        $collect_file = array();

        foreach ($request->receiver_id as $receiver_id) {
            $input['receiver_id'] = $receiver_id;

            // check new receiver
            if ((int)$request->receiver_type == 0) {
                $receiver = Receiver::find($receiver_id);
                if ($receiver == null) {
                    $new_receiver = Receiver::create(['name' => $receiver_id, 'type' => 0]);
                    $input['receiver_id'] = $new_receiver->id;
                }
            }

            $outbox = Outbox::create($input);
            if (!$outbox) {
                return back()->with('error', 'Gagal menambah surat keluar baru!');
            }

            if ($request->hasFile('attachment') && count($collect_file) == 0)
            {
                $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
                foreach ($request->file('attachment') as $index => $file) {
                    $title = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $name = 'outbox_'. date('d_m_Y') .'_'. str_random(10).'.'. $extension;
                    $size = $file->getSize();
                    $check = in_array(strtolower($extension), $allowedfileExtension);
                    //dd($check);
                    if ($check) {
                        $attachment = new Attachment([
                            'user_id' => auth()->user()->id,
                            'title' => $title,
                            'name' => $name,
                            'ext' => $extension,
                            'size' => $size,
                            'order' => $index
                        ]);
                        $collect_file[] = $attachment;
                        $file->move(public_path('storage'), $name);
                    }
                }
            }

            if (count($collect_file) > 0) {
                $outbox->update(['is_attachment' => 1]);
                if ($loop == 1) {
                    $outbox->attachments()->saveMany($collect_file);
                } else {
                    foreach ($collect_file as $attachment) {
                        $replicate = $attachment->replicate();
                        $replicate->attachable_id = $outbox->id;
                        $replicate->save();
                    }
                }
            }

            $loop++;
        }

        return redirect('/surat-keluar')->with('success', 'Berhasil menambah surat keluar baru');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = Category::orderBy('name')->get();
        $outbox     = Outbox::with('receiver')->where('id', $id)->first();
        $receivers  = $this->customReceiver();

        return view('outbox.edit', compact('outbox', 'receivers', 'categories'));
    }

    public function update(SuratKeluarRequest $request, $id)
    {
        $input = $request->all();
        $outbox = Outbox::findOrFail($id);

        if ($request->hasFile('attachment'))
        {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
            $files = $request->file('attachment');
            $collect_file = array();
            foreach ($files as $index => $file) {
                $title = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = 'outbox_'. date('d_m_Y') .'_'. str_random(10). '.'. $extension;
                $size = $file->getSize();
                $check = in_array(strtolower($extension), $allowedfileExtension);
                //dd($check);
                if ($check) {
                    $attachment = new Attachment([
                        'user_id' => auth()->user()->id,
                        'title' => $title,
                        'name' => $name,
                        'ext' => $extension,
                        'size' => $size,
                        'order' => $index
                    ]);
                    $collect_file[] = $attachment;
                    $file->move(public_path('storage'), $name);
                }
            }

            $outbox->update(['is_attachment' => 1]);
            $outbox->attachments()->saveMany($collect_file);
        }

        // check attachments status
        if ($request->has('uploaded_file')) {
            foreach ($request->uploaded_file as $key => $status) {
                if ($status == 'removed') {
                    $uploaded_file = $outbox->attachments()->where('id', $key)->first();
                    if ($uploaded_file !== null) {
                        // unlink( public_path('storage/' . $uploaded_file->name) );
                        $uploaded_file->delete();
                    }
                }
            }
        }

        // check new receiver
        if ((int)$request->receiver_type == 0) {
            $receiver = Receiver::find($request->receiver_id);
            if ($receiver == null) {
                $new_receiver = Receiver::create(['name' => $request->receiver_id, 'type' => 0]);
                $input['receiver_id'] = $new_receiver->id;
            }
        }

        $outbox->update($input);

        return redirect('/surat-keluar')->with('success', 'Berhasil mengubah data surat keluar');
    }

    public function destroy($id)
    {
        $outbox = Outbox::find($id);
        if ($outbox == null) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        // remove outbox
        $outbox->removeRelatedData();
        $outbox->update(['deleted_by' => auth()->user()->id]);
        $outbox->delete();

        return redirect('/surat-keluar')->with('success', 'Berhasil menghapus data surat keluar');
    }

    private function customReceiver()
    {
        $receivers = Receiver::get(['id', 'name', 'type']);
        return $receivers;
    }
}
