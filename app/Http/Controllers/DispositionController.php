<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Biro;
use App\Disposition;

class DispositionController extends Controller
{
    public function detail(Request $request, $id)
    {
        $type = 'edit';
        $disposition = Disposition::where('inbox_id', $id)->first();
        if ($disposition == null) {
            $type = 'add';
            return response()->json([
                'success' => true,
                'type' => $type,
                'data' => ['no_agenda' => $this->formatNoAgenda($request->biro_id)]
            ]);
        }

        return response()->json([
            'success' => true,
            'type' => $type,
            'data' => [
                'id' => $disposition->id,
                'no_agenda' => $disposition->no_agenda,
                'kop' => $disposition->kop,
                'ttd' => $disposition->ttd,
                'property' => $disposition->property,
                'sender' => $disposition->sender,
                'date_receipt' => $disposition->date_only,
                'date_indo_receipt' => $disposition->date_receipt_indo,
                'time_receipt' => $disposition->time_receipt,
                'description' => $disposition->description,
                'is_ttd' => $disposition->is_ttd_reverse,
            ]
        ]);
    }

    private function lastNoAgenda($biro_id)
    {
        $disposition = Disposition::whereHas('inbox', function ($q) use ($biro_id) {
            $q->where('biro_id', $biro_id);
        })
            ->whereYear('created_at', date('Y'))
            ->orderBy('counter', 'desc')
            ->first();

        return $disposition->no_agenda ?? 0;
    }

    private function biroFormat($biro_id)
    {
        $biro = Biro::findOrFail($biro_id);
        if ($biro->name == 'Biro Umum (TU. Pimpinan)') {
            return 'TUPIM';
        }

        $split = explode("-", $biro->slug);
        return 'B.' . ucfirst($split[1]);
    }

    private function extractNoAgenda($no_agenda)
    {
        if ($no_agenda === 0) {
            return 1;
        }
        $split = explode("/", $no_agenda);
        return (int) $split[0] + 1;
    }

    private function formatNoAgenda($biro_id = null)
    {
        $id     = $biro_id ?? auth()->user()->biro_id;
        $number = $this->extractNoAgenda($this->lastNoAgenda($id));
        $format = str_pad($number, 2, '0', STR_PAD_LEFT);

        return $format . '/' . $this->biroFormat($id) . '/' . date('m') . '/' . date('Y');
    }
}
