<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Requests\SptRequest;
use App\Inbox;
use App\Jobs\SendWhatsAppJob;
use App\Outbox;
use App\Skpd;
use App\SkpdEmployee;
use App\Spt;
use App\SptSigner;
use App\SptTemplate;
use Illuminate\Http\Request;

class SptController extends Controller
{
    public function index(Request $request)
    {
        $spts = Spt::filter($request)->orderBy('is_accepted')->orderBy('id', 'desc')->limit(100)->get();

        return view('spt.index', compact('spts'));
    }

    public function search()
    {
        return view('spt.search');
    }

    public function create(Request $request)
    {
        $biro_id = auth()->user()->biro_id;
        $inboxes = Inbox::where('biro_id', $biro_id)->orderBy('id', 'desc')->limit(1000)->get(['id', 'title', 'no', 'sender']);
        $skpds = Skpd::orderBy('name')->get();
        $last_spt = Spt::orderBy('letter_number', 'desc')->first(['id', 'letter_number']);
        $skpd_employees = SkpdEmployee::orderBy('name')->get();
        $signers = SptSigner::orderBy('label')->get();
        $current_date = full_indo_date(date('Y-m-d'));
        $get_inbox_id = $request->inbox_id ?? null;
        if ($last_spt == null) {
            $last_spt_number = 1;
        } else {
            $last_spt_number = $last_spt->letter_number + 1;
        }

        return view('spt.create', compact('inboxes', 'skpds', 'skpd_employees', 'last_spt_number', 'signers', 'current_date', 'get_inbox_id'));
    }

    public function edit($id)
    {
        $spt = Spt::findOrFail($id);
        $biro_id = auth()->user()->biro_id;
        $inboxes = Inbox::where('biro_id', $biro_id)->orderBy('id', 'desc')->limit(1000)->get(['id', 'title', 'no', 'sender']);
        $skpds = Skpd::orderBy('name')->get();
        $skpd_employees = SkpdEmployee::orderBy('name')->get();
        $signers = SptSigner::orderBy('label')->get();
        $letter_date_indo = full_indo_date($spt->letter_date);
        $departure_date_indo = full_indo_date($spt->departure_date);
        $return_date_indo = full_indo_date($spt->return_date);
        $get_inbox_id = null;
        $last_spt_number = 0;

        return view('spt.edit', compact('spt', 'inboxes', 'skpds', 'skpd_employees', 'last_spt_number', 'signers', 'letter_date_indo', 'departure_date_indo', 'return_date_indo', 'get_inbox_id'));
    }

    public function store(SptRequest $request)
    {
        $input = $request->all();
        // map skpd employees
        $pejabat = "";
        $skpd_employees = ['id' => [], 'name' => []];
        foreach ($input['skpd_employee_id'] as $key => $id) {
            $skpd_employees['id'][] = $id;
            $skpd_employees['name'][] = $input['skpd_employee_name'][$key];
            $pejabat .= $input['skpd_employee_name'][$key] . ", ";
        }

        // map additional letter signerx
        $letter_signers = ['name' => [], 'position' => []];
        foreach ($input['paraf_name'] as $key => $val) {
            if ($val !== null) {
                $letter_signers['name'][] = $val;
                $letter_signers['position'][] = $input['paraf_position'][$key];
            }
        }

        $input["skpd_employee"] = json_encode($skpd_employees);
        if (count($letter_signers['name']) > 0) {
            $input["letter_signers"] = json_encode($letter_signers);
        }

        $spt = Spt::create($input);

        // create outbox
        $pejabat = substr($pejabat, 0, -2);
        $title = "SPT A.N. " . $pejabat . " KE " . $spt->destination;
        $outbox_data = [
            "biro_id" => $spt->inbox->biro_id,
            "user_id" => $spt->inbox->user_id,
            "no" => "800.1.11.1/" . $spt->letter_number . "/B.Um.I",
            "title" => $title,
            "date" => $spt->letter_date,
            "date_entry" => date('Y-m-d'),
            "category_id" => $spt->inbox->category_id,
            "receiver_id" => $spt->inbox->receiver_id,
            "description" => $spt->inbox->description
        ];

        // duplicate attachment from old inbox
        $clone_attachment = array();
        if ($spt->inbox->is_attachment) {
            $outbox_data["is_attachment"] = 1;
            foreach ($spt->inbox->attachments as $attachment) {
                $clone_attachment[] = new Attachment([
                    'user_id' => $attachment->user_id,
                    'title' => $attachment->title,
                    'name' => $attachment->name,
                    'ext' => $attachment->ext,
                    'size' => $attachment->size,
                    'order' => $attachment->order
                ]);
            }
        }

        $outbox = Outbox::create($outbox_data);
        $outbox->attachments()->saveMany($clone_attachment);

        return redirect('/spt')->with('success', 'Berhasil menambah data SPT baru');
    }

    public function update(SptRequest $request, $id)
    {
        $spt = Spt::findOrFail($id);
        $input = $request->all();
        // map skpd employees
        $skpd_employees = ['id' => [], 'name' => []];
        foreach ($input['skpd_employee_id'] as $key => $id) {
            $skpd_employees['id'][] = $id;
            $skpd_employees['name'][] = $input['skpd_employee_name'][$key];
        }

        // map additional letter signerx
        $letter_signers = ['name' => [], 'position' => []];
        foreach ($input['paraf_name'] as $key => $val) {
            if ($val !== null) {
                $letter_signers['name'][] = $val;
                $letter_signers['position'][] = $input['paraf_position'][$key];
            }
        }

        $input["skpd_employee"] = json_encode($skpd_employees);
        $input["letter_signers"] = null;
        if (count($letter_signers['name']) > 0) {
            $input["letter_signers"] = json_encode($letter_signers);
        }

        $spt->update($input);

        return redirect('/spt')->with('success', 'Berhasil memperbarui data SPT');
    }

    public function destroy($id)
    {
        $spt = Spt::findOrFail($id);
        $spt->delete();

        return back()->with('success', 'Berhasil menghapus data SPT');
    }

    public function show($id)
    {
        $spt = Spt::findOrFail($id);

        return view('spt.print', compact('spt'));
    }

    public function accept(Request $request)
    {
        $spts = Spt::whereIn('id', explode(",", $request->list_id))->get();
        foreach ($spts as $spt) {
            $spt->update(['is_accepted' => 1]);
            $this->sendSptNotification($spt);
        }

        return back()->with('success', 'Berhasil menerima data SPT');
    }

    private function sendSptNotification($spt)
    {
        $skpd_number = $spt->skpd->wa_number;
        if ($skpd_number != null && $skpd_number != "") {
            $spt_template = SptTemplate::where('id', 4)->first();
            $message = $spt_template->content;
            $message = str_replace("<skpd>", $spt->skpd->name, $message);
            $message = str_replace("<pejabat>", $spt->employee_list, $message);
            $message = str_replace("<tanggal>", $spt->date_range, $message);
            $message = str_replace("<tujuan>", $spt->destination, $message);
            $message = str_replace("<br>", " ", $message);
            $format = [
                'template' => 'spt',
                'username' => auth()->user()->username ?? '-',
                'phone' => $skpd_number,
                'message' => $message,
                'username' => auth()->user()->username
            ];

            SendWhatsAppJob::dispatch($format)->onQueue('notif_wa');
        }
    }
}
