<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\SuratMasukRequest;
use App\Pejabat;
use App\Inbox;
use App\Outbox;
use App\Receiver;
use App\Category;
use App\Biro;
use App\Attachment;
use App\ArchiveInfo;
use App\AgendaApparel;
use App\AgendaPlace;
use App\AgendaDisposition;
use App\AgendaPartner;
use App\AgendaReceiver;
use App\Archive;
use App\ArchiveBundle;
use App\ArchiveBundleDetail;
use App\DispositionAdmin;
use App\Jobs\SendWhatsAppJob;
use App\User;
use Illuminate\Support\Facades\Log;

class InboxController extends Controller
{
    public function index(Request $request)
    {
        $user_id = auth()->user()->id;
        $biro_id = auth()->user()->biro_id;
        $biros   = Biro::where('id', '!=', $biro_id)->pluck('name', 'id');
        $inboxes = $this->inboxDataPerBiro($biro_id);
        $sekdas  = Pejabat::where('type', 0)->get();
        $date    = to_indo_day(date('N')) . ', ' . to_indo_date(date('Y-m-d'), 1);
        $status_disposisi = $sekdas[0]->is_ttd_area_reverse;
        // cek jika user biro maka ambil user id karo nya
        if (substr(auth()->user()->username, 0, 4) === 'biro') {
            $user = User::where('username', 'like', '%karo%')->where('biro_id', $biro_id)->first();
            $user_id = $user->id;
        }

        return view('inbox.index', compact('inboxes', 'biros', 'sekdas', 'date', 'status_disposisi', 'user_id'));
    }

    public function superForward(Request $request)
    {
        $user_id = auth()->user()->id;
        $biro_id = auth()->user()->biro_id;
        $biros   = Biro::where('id', '!=', $biro_id)->pluck('name', 'id');
        $inboxes = $this->inboxDataPerForward();
        $sekdas  = Pejabat::where('type', 0)->get();
        $date    = to_indo_day(date('N')) . ', ' . to_indo_date(date('Y-m-d'), 1);
        $status_disposisi = $sekdas[0]->is_ttd_area_reverse;

        return view('inbox.super_forward', compact('inboxes', 'biros', 'sekdas', 'date', 'status_disposisi', 'user_id'));
    }

    public function detail($id)
    {
        $inbox = Inbox::withTrashed()->findOrFail($id);
        $no_agenda = $inbox->disposition->no_agenda ?? '-';
        $sifat = $inbox->disposition->property_formatted ?? '-';

        if ($inbox->visitor_id !== null) {
            $no_agenda = $inbox->visitor->no_agenda ?? '-';
            $sifat = $inbox->visitor->property_formatted ?? '-';
        }

        if ($inbox->disposition_admin()->count() > 0) {
            $disposition_admin = array();
            foreach ($inbox->disposition_admin as $index => $dispo) {
                if ($index == 0) {
                    $disposition_admin[] = $dispo->user->receiver->name;
                }

                if ($dispo->receiver->name == 'ARSIP') {
                    $disposition_admin[] = 'ARSIP ' . $dispo->user->receiver->name;
                } else {
                    $disposition_admin[] = $dispo->receiver->name . ' ' . ($dispo->position ?? '');
                }
            }
        }

        $data = [
            'no_surat' => $inbox->no,
            'title' => $inbox->title,
            'date' => $inbox->date_formatted,
            'date_entry' => $inbox->date_entry_formatted,
            'sender' => $inbox->sender,
            'category' => $inbox->category->name,
            'receiver' => $inbox->receiver->name,
            'description' => $inbox->description ?? '-',
            'is_attachment' => $inbox->is_attachment == 0 ? false : true,
            'attachments' => $inbox->attachments,
            'no_agenda' => $no_agenda,
            'sifat' => $sifat,
            'forward_note' => $inbox->forwards[0]->note ?? '-',
            'dispositions' => $disposition_admin ?? null,
        ];

        return response()->json(['data' => $data]);
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $receivers  = $this->customReceiver();
        $date       = to_indo_day(date('N')) . ', ' . to_indo_date(date('Y-m-d'), 1);

        return view('inbox.create', compact('categories', 'receivers', 'date'));
    }

    public function store(SuratMasukRequest $request)
    {
        $input = $request->all();
        $inbox = Inbox::create($input);
        if (!$inbox) {
            return back()->with('error', 'Gagal menambah surat masuk baru!');
        }

        if ($request->hasFile('attachment')) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
            $files = $request->file('attachment');
            $collect_file = array();
            foreach ($files as $index => $file) {
                $title = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = 'inbox_' . date('d_m_Y') . '_' . str_random(10) . '.' . $extension;
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

            $inbox->update(['is_attachment' => 1]);
            $inbox->attachments()->saveMany($collect_file);
        }

        // kirim notifikasi untuk surat baru jika user tupim
        $this->NotifWaTupim($inbox);

        if (($input['is_spt'] ?? null) !== null) {
            return redirect('/spt/create?inbox_id=' . $inbox->id)->with('success', 'Berhasil menambah surat masuk baru');
        }

        return redirect('/surat-masuk')->with('success', 'Berhasil menambah surat masuk baru');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $inbox      = Inbox::findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $receivers  = $this->customReceiver();

        return view('inbox.edit', compact('inbox', 'categories', 'receivers'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $inbox = Inbox::findOrFail($id);

        if ($request->hasFile('attachment')) {
            $allowedfileExtension = ['pdf', 'jpg', 'jpeg', 'png'];
            $files = $request->file('attachment');
            $collect_file = array();
            foreach ($files as $index => $file) {
                $title = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $name = 'inbox_' . date('d_m_Y') . '_' . str_random(10) . '.' . $extension;
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

            $inbox->update(['is_attachment' => 1]);
            $inbox->attachments()->saveMany($collect_file);
        }

        // check attachments status
        if ($request->has('uploaded_file')) {
            foreach ($request->uploaded_file as $key => $status) {
                if ($status == 'removed') {
                    $uploaded_file = $inbox->attachments()->where('id', $key)->first();
                    if ($uploaded_file !== null) {
                        // unlink( public_path('storage/' . $uploaded_file->name) );
                        $uploaded_file->delete();
                    }
                }
            }
        }

        $inbox->update($input);

        return redirect('/surat-masuk')->with('success', 'Berhasil mengubah data surat masuk');
    }

    public function destroy($id)
    {
        $inbox = Inbox::find($id);
        if ($inbox == null) {
            return back()->with('error', 'Data tidak ditemukan!');
        }

        // remove inbox
        $inbox->removeRelatedData();
        $inbox->update(['deleted_by' => auth()->user()->id]);
        $inbox->delete();

        return redirect('/surat-masuk')->with('success', 'Berhasil menghapus data surat masuk');
    }

    public function agenda($id)
    {
        $inbox = Inbox::findOrFail($id);
        $date = Carbon::parse($inbox->date);
        $input = [
            'inbox_id' => $inbox->id,
            'inbox_no' => $inbox->no,
            'apparels' => AgendaApparel::all(),
            'places' => AgendaPlace::all(),
            'dispositions' => AgendaDisposition::all(),
            'partners' => AgendaPartner::all(),
            'receivers' => AgendaReceiver::get(['id', 'name']),
            'receiver_default' => $this->defaultReceiver(),
            'date' => to_indo_day($date->copy()->format('N')) . ', ' . to_indo_date($date->copy()->format('Y-m-d'), 1),
            'inbox_description' => $inbox->title,
            'inboxes' => $this->inboxReference()
        ];

        return view('agenda.schedule.create', $input);
    }

    public function arsip(Request $request)
    {
        // generate new bundle from inbox id
        $archives = array();
        $list_id  = explode(",", $request->list_surat_id);
        $model    = $request->type == 'masuk' ? Inbox::class : Outbox::class;
        foreach ($list_id as $id) {
            $model = $model::findOrFail($id);
            $model->update(['is_archived' => 0]);
            $model->archive()->save(new Archive([
                'biro_id' => auth()->user()->biro_id,
                'date' => date('Y-m-d'),
                'status' => 'p'
            ]));

            $archives[] = new ArchiveBundleDetail(['archive_id' => $model->archive->id]);
        }

        $bundle = ArchiveBundle::create(['type' => $request->type, 'total' => count($list_id)]);
        $bundle->details()->saveMany($archives);

        return back()->with('success', 'Berhasil mengirim data arsip ' . $request->type);
    }

    public function allAttachments(Request $request)
    {
        $model = $request->type == 'inbox' ? Inbox::class : Outbox::class;
        $model = $model::findOrFail($request->id);

        return view('inbox.all-attachments', [
            'status' => $model->is_attachment,
            'attachments' => $model->attachments_order ?? null
        ]);
    }

    private function defaultReceiver()
    {
        $biro = strtoupper(auth()->user()->biro->name);
        return AgendaReceiver::where('name', $biro)->first();
    }

    private function customReceiver()
    {
        $biro = strtoupper(auth()->user()->biro->name);
        $receivers = Receiver::where('name', $biro)->first();
        if ($receivers == null) {
            $receivers = Receiver::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 1980])->get(['id', 'name', 'type']);
        }

        return $receivers;
    }

    private function inboxReference($except_id = null)
    {
        $inboxes = Inbox::where('is_agenda', 0)->where('is_archived', NULL);
        if ($except_id != null) {
            $inboxes = $inboxes->orWhere('id', $except_id);
        }
        return $inboxes->get(['id', 'no']);
    }

    private function inboxDataPerBiro($biro_id)
    {
        // jikau user admin atau karo
        $user_id = auth()->user()->id;
        $username = auth()->user()->username;
        $receiver_id = auth()->user()->receiver_id;

        // // cari per data disposisi
        // $dispositions = DispositionAdmin::where('user_id', $user_id)
        //     ->orderBy('id', 'desc')
        //     ->pluck('inbox_id');

        // filtering data untuk user admin
        if (strpos($username, 'admin') !== false || strpos($username, 'pj') !== false) {
            return Inbox::where('receiver_id', $receiver_id)
                ->where('visitor_id', NULL)
                ->where('reference_id', NULL)
                ->where('unique_key', '!=', NULL)
                // ->whereNotIn('id', $dispositions)
                // ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
        }

        // filtering data untuk user karo
        if (strpos($username, 'karo') !== false) {
            return Inbox::where('biro_id', $biro_id)
                ->where('reference_id', NULL)
                ->where('unique_key', '!=', NULL)
                // ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
        }

        return Inbox::where('biro_id', $biro_id)->orderBy('id', 'desc')->limit(50)->get();
    }

    private function inboxDataPerForward()
    {
        $biro_id = auth()->user()->biro_id;
        $user_id = auth()->user()->id;
        $username = auth()->user()->username;
        $receiver_id = auth()->user()->receiver_id;

        $dispositions = DispositionAdmin::where('receiver_id', $receiver_id)
            // ->whereMonth('created_at', Carbon::now()->month)
            ->orderBy('id', 'desc')
            ->pluck('inbox_id');

        // where('user_id', $user_id) --> ini di hapus aja dlu krna blm perlu tamu

        if (strpos($username, 'admin') !== false || strpos($username, 'pj') !== false) {
            return Inbox::whereIn('id', $dispositions)
                // ->orWhere('receiver_id', $receiver_id)
                // ->where('visitor_id', '!=', NULL)
                ->where('unique_key', '!=', NULL)
                // ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
        }

        if (strpos($username, 'karo') !== false) {
            return Inbox::where('biro_id', $biro_id)
                ->where('reference_id', '!=', NULL)
                ->where('unique_key', '!=', NULL)
                // ->whereMonth('created_at', Carbon::now()->month)
                ->orderBy('id', 'desc')
                ->limit(50)
                ->get();
        }

        return Inbox::whereIn('id', $dispositions)->orderBy('id', 'desc')->limit(50)->get();
    }

    private function NotifWaTupim($inbox)
    {
        $user_receiver = User::where('receiver_id', $inbox->receiver_id)->first();
        if ($user_receiver === null) {
            Log::error("User Tujuan " . $inbox->receiver->name . " belum ada.");
            return true;
        }

        if ($user_receiver->wa === null) {
            Log::error("Nomor WA untuk tujuan " . $inbox->receiver->name . " belum ada");
            return true;
        }

        $data_surat = [
            'template' => 'cek_status',
            'username' => auth()->user()->username ?? '-',
            'code' => null,
            'tipe' => 'new',
            'phone' => $user_receiver->wa,
            'instansi' => $inbox->sender,
            'no_surat' => $inbox->no ?? '-',
            'dari' => 'TU. Pimpinan',
            'tujuan' => $inbox->receiver->name,
            'judul' => $inbox->title,
            'status' => 'Perlu Disposisi',
        ];

        SendWhatsAppJob::dispatch($data_surat)->onQueue('notif_wa');
    }
}
