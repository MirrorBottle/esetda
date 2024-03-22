<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\SendWhatsAppJob;
use App\Biro;
use App\Pejabat;
use App\Forward;
use App\Category;
use App\Inbox;
use App\Outbox;
use App\Attachment;
use App\User;
use Illuminate\Support\Facades\Log;

class ForwardController extends Controller
{
    public function index(Request $request)
    {
        $forwards = $this->forwardsData();
        $date     = to_indo_day(date('N')) . ', ' . to_indo_date(date('Y-m-d'), 1);
        $sekdas   = Pejabat::where('type', 0)->get();
        $status_disposisi = $sekdas[0]->is_ttd_area_reverse;

        return view('forward.index', compact('forwards', 'date', 'sekdas', 'status_disposisi'));
    }

    public function accept($id)
    {
        $forward = Forward::findOrFail($id);
        $forward->update(['is_received' => 1]);

        return redirect('/surat-terusan')->with('success', 'Surat terusan berhasil di tanda terima');
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('forward.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // remove all forwards when update
        if ($request->save_type == 'update') {
            if ($request->inbox_id !== null) {
                $current_forwards = Forward::where('inbox_id', $request->inbox_id);
            } else {
                $current_forwards = Forward::where('outbox_id', $request->outbox_id);
            }
            $current_forwards->delete();
        }

        // change forwarded status
        $model = $request->inbox_id !== null ? Inbox::class : Outbox::class;
        $model = $model::findOrFail($request->inbox_id ?? $request->outbox_id);
        $model->update(['is_forwarded' => true]);

        $data = array();
        foreach ($request->biro_id as $biro_id) {
            $data[] = [
                'biro_id' => $biro_id,
                'user_id' => auth()->user()->id,
                'inbox_id' => $request->inbox_id ?? null,
                'outbox_id' => $request->outbox_id ?? null,
                'note' => $request->note,
                'created_at' => date('Y-m-d H:i'),
            ];
        }

        $add = Forward::insert($data);

        if (!$add) {
            return back()->with('error', 'Gagal menambah surat terusan baru!');
        }

        // send notification
        $this->sendWhatsAppBot($model, $request->all());

        return back()->with('success', 'Berhasil menambah surat terusan baru');
    }

    public function destroy(Request $request, $id)
    {
        if ($request->inbox_id !== null) {
            $inbox = Inbox::findOrFail($request->inbox_id);
            $inbox->update(['is_forwarded' => false]);
            $forwards = Forward::where('inbox_id', $request->inbox_id);
        } else {
            $outbox = Outbox::findOrFail($request->outbox_id);
            $outbox->update(['is_forwarded' => false]);
            $forwards = Forward::where('outbox_id', $request->outbox_id);
        }

        $remove = $forwards->delete();
        if (!$remove) {
            return back()->with('error', 'Gagal membatalakan surat terusan!');
        }

        return back()->with('success', 'Berhasil membatalkan surat terusan');
    }

    public function check($type, $id)
    {
        $forwards = Forward::where($type . '_id', $id)->get(['id', 'biro_id', 'note']);
        if ($forwards->isEmpty()) {
            return response()->json(['data' => null]);
        }

        $list_biro = '';
        foreach ($forwards as $forward) {
            $list_biro .= $forward->biro_id . ',';
        }

        return response()->json([
            'data' => [
                'biro_id' => substr($list_biro, 0, -1),
                'note' => $forwards[0]->note
            ]
        ]);
    }

    public function attachmentCheck($id)
    {
        $forward = Forward::findOrFail($id);
        if ($forward->is_attachment) {
            return response()->json(['data' => $forward->attachments]);
        }

        return response()->json(['data' => null]);
    }

    public function attachmentUpdate(Request $request, $id)
    {
        $model = $request->type == 'inbox' ? Inbox::class : Outbox::class;
        $model = $model::findOrFail($id);
        if ($request->hasFile('attachment')) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
            $files = $request->file('attachment');
            $collect_file = array();
            foreach ($files as $index => $file) {
                $title = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = $request->type . '_' . date('d_m_Y') . '_' . str_random(10) . '.' . $extension;
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

            $model->update(['is_attachment' => 1]);
            $model->attachments()->saveMany($collect_file);
        }

        // check attachments status
        if ($request->has('uploaded_file')) {
            foreach ($request->uploaded_file as $key => $status) {
                if ($status == 'removed') {
                    $uploaded_file = $model->attachments()->where('id', $key)->first();
                    // unlink( public_path('storage/' . $uploaded_file->name) );
                    $uploaded_file->delete();
                }
            }
        }

        return back()->with('success', 'Berhasil memperbarui lampiran surat');
    }

    public function noteUpdate(Request $request, $id)
    {
        $model = $request->type == 'inbox' ? Inbox::class : Outbox::class;
        $model = $model::findOrFail($id);
        $model->update(['description' => $request->description]);

        return back()->with('success', 'Berhasil memperbarui keterangan surat');
    }

    public function count()
    {
        $biro_id = auth()->user()->biro_id;
        $total = Forward::where('biro_id', $biro_id)->where('is_received', false)->count();

        return response()->json(['total' => $total]);
    }

    public function duplicate(Request $request)
    {
        $model = $request->type == 'inbox' ? Inbox::class : Outbox::class;
        $data  = $model::findOrFail($request->id);
        if ($request->type == 'inbox' && $data->unique_key === null) {
            $data->update(['unique_key' => unique_key()]);
        }

        $input = $data->toArray();
        $input['is_forwarded']  = 0;
        $input['is_agenda']     = 0;
        $input['is_archived']   = NULL;
        if ($request->type == 'outbox') {
            $input['sender'] = $data->biro->name;
        }

        $new = $model::create($input);
        $new->update(['reference_id' => $request->id]);

        // duplicate attachment from old inbox
        $clone_attachment = array();
        if ($data->is_attachment) {
            foreach ($data->attachments as $attachment) {
                $clone_attachment[] = new Attachment([
                    'user_id' => $attachment->user_id,
                    'title' => $attachment->title,
                    'name' => $attachment->name,
                    'ext' => $attachment->ext,
                    'size' => $attachment->size,
                    'order' => $attachment->order
                ]);
            }

            $new->attachments()->saveMany($clone_attachment);
        }

        // kirim notifikasi ke karo
        if ($request->type == 'inbox') {
            $this->NotifWaKaro($new);
        }

        return back()->with('success', 'Berhasil menduplikasi surat');
    }

    private function sendWhatsAppBot($model, $input)
    {
        foreach ($input['biro_id'] as $biro_id) {
            $user = auth()->user();
            $biro = Biro::findOrFail($biro_id);
            $wa   = $biro->userOperatorWa();
            if ($wa !== null) {
                $data = [
                    'template' => 'surat_terusan',
                    'username' => auth()->user()->username ?? '-',
                    'phone' => $wa,
                    'sender' => $user->name,
                    'biro' => $user->biro->name,
                    'title' => $model->title,
                    'category' => $model->category->name,
                    'note' => $input['note'] ?? '-',
                    'url' => url('surat-terusan')
                ];

                SendWhatsAppJob::dispatch($data)->onQueue('notif_wa');
            }
        }
    }

    private function forwardsData()
    {
        return Forward::where('biro_id', auth()->user()->biro_id ?? 1)
            ->where('user_id', '!=', auth()->user()->id)
            // ->orderBy('is_received', 'asc')
            ->orderBy('id', 'desc')
            ->limit(50)
            ->get();
    }

    private function NotifWaKaro($inbox)
    {
        $biro_id = auth()->user()->biro_id;
        $user_receiver = User::where('username', 'like', '%karo%')->where('biro_id', $biro_id)->first();
        $disposition   = $inbox->disposition_admin()->where('receiver_id', $user_receiver->receiver_id)->first();

        if ($user_receiver->wa === null) {
            Log::error("Nomor WA untuk tujuan Kepala " . $user_receiver->receiver->name . " belum ada");
            return true;
        }

        // sender dari disposisi atau dari biro pengirim jika dia data lama
        $sender = $disposition->user->receiver->name ?? $inbox->reference->biro->name;

        $data_surat = [
            'template' => 'cek_status',
            'username' => auth()->user()->username ?? '-',
            'code' => null,
            'tipe' => 'new',
            'phone' => $user_receiver->wa,
            'instansi' => $inbox->sender,
            'no_surat' => $inbox->no ?? '-',
            'dari' => $sender,
            'tujuan' => $user_receiver->receiver->name,
            'judul' => $inbox->title,
            'status' => 'Perlu Disposisi',
        ];

        SendWhatsAppJob::dispatch($data_surat)->onQueue('notif_wa');
    }
}
