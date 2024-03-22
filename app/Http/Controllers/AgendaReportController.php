<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use App\AgendaReceiver;
use App\PetugasTtd;
use Carbon\Carbon;
use DomPdf;

class AgendaReportController extends Controller
{
    public function index()
    {
        $date = to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1);
        $receivers = AgendaReceiver::get(['id', 'name']);
        $default = $this->defaultReceiver();

        return view('agenda.report.index', compact('date', 'receivers', 'default'));
    }

    public function report(Request $request)
    {
        $data       = Agenda::filter($request)->get();
        $file_name  = $this->reportFileName($request);
        $path       = public_path('storage/'. $file_name);

        $dompdf     = DomPdf::loadView('agenda.report.print', [
            'data' => $data,
            'ttd' => $this->petugasTtd(),
            'date_now' => to_indo_date(date('Y-m-d'), 1),
            'date_start' => to_indo_date(Carbon::parse($request->date_start)->format('Y-m-d')),
            'date_end' => to_indo_date(Carbon::parse($request->date_end)->format('Y-m-d')),
        ]);

        $dompdf->setPaper('a4', 'landscape');
        $dompdf->save($path);

        return redirect('storage/'. $file_name);
    }

    private function reportFileName($request)
    {
        $date_start = Carbon::parse($request->date_start)->format('d_m_Y');
        $date_end   = Carbon::parse($request->date_end)->format('d_m_Y');

        return 'Laporan_Jadwal_Kegiatan_'. $date_start .'_sd_'. $date_end .'.pdf';
    }

    private function petugasTtd()
    {
        return PetugasTtd::where('type', 'agenda')->first();
    }

    private function defaultReceiver()
    {
        if (auth()->user()->isAdmin()) { return null; }

        $code = str_replace("agenda_", "", auth()->user()->username);
        return AgendaReceiver::where('code', $code)->first();
    }
}
