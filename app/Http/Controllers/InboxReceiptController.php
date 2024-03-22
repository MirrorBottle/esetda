<?php

namespace App\Http\Controllers;

use App\Inbox;
use App\Kop;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InboxReceiptController extends Controller
{
    public function index(Request $request)
    {
        $start       = $request->date_start !== null ? Carbon::parse($request->date_start) : new Carbon('first day of last month');
        $end         = $request->date_end !== null ? Carbon::parse($request->date_end) : Carbon::now();
        $date_start  = $start->copy()->format('Y-m-d');
        $date_end    = $end->copy()->format('Y-m-d');
        $inboxes     = $this->receiptInbox($date_start, $date_end);
        $data = [
            'inboxes' => $inboxes['data'],
            'list_id' => $inboxes['list_id'],
            'date_start_indo' => $this->formaIndoDateTime($start),
            'date_end_indo' => $this->formaIndoDateTime($end),
            'date_start' => $date_start,
            'date_end' => $date_end,
        ];

        return view('receipt.index', $data);
    }

    public function update(Request $request)
    {
        $kop_id = 3;
        $list_item = explode(",", $request->item);
        $list_id = explode(",", $request->id);
        $list_instruction = explode(",", $request->instruction);

        $update_inbox = Inbox::whereIn('id', $list_id)->get();
        foreach ($update_inbox as $key => $inbox) {
            $inbox->update(['instruction' => $list_instruction[$key]]);
        }

        $data = Inbox::whereIn('id', $list_item)->orderBy('date_entry', 'desc')->get();

        return view('print.instruction', [
            'data' => $data,
            'kop' => Kop::find($kop_id),
            'date_start' => $this->formatPrintDate($request->date_start),
            'date_end' => $this->formatPrintDate($request->date_end)
        ]);
    }

    private function receiptInbox($date_start, $date_end)
    {
        $biro_id = auth()->user()->biro_id;
        $inboxes = Inbox::where('biro_id', $biro_id)
            ->whereDate('date_entry', '>=' , $date_start)
            ->whereDate('date_entry', '<=', $date_end)
            ->orderBy('date_entry', 'desc');

        return [
            'data' => $inboxes->get(),
            'list_id' => $inboxes->whereNull('instruction')->pluck('id')
        ];
    }

    private function formaIndoDateTime($carbon_date)
    {
        $date = $carbon_date->copy();
        return to_indo_day($date->format('N')) .', '. to_indo_date($date->format('Y-m-d'), 1);
    }

    private function formatPrintDate($date)
    {
        $date = Carbon::parse($date);
        return $date->format('d_m_Y');
    }
}
