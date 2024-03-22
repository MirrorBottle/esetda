<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Biro;
use App\Archive;
use App\PetugasTtd;
use Carbon\Carbon;
use DomPdf;

class ArchiveReportController extends Controller
{
    public function index()
    {
        $date = to_indo_day(date('N')) .', '. to_indo_date(date('Y-m-d'), 1);
        $biros = Biro::get(['id', 'name']);

        return view('archive.report.index', compact('date', 'biros'));
    }

    public function report(Request $request)
    {
        $type = $request->type;
        if (auth()->user()->isAdmin()) {
            $data = Archive::where('status', 'a')
                ->filterType($type)
                ->filter($request);

            if ($request->has('biro_id')) {
                $data = $data->whereIn('biro_id', $request->biro_id);
            }
        } else {
            $data = Archive::where('status', 'a')
                ->filterBiro()
                ->filterType($type)
                ->filter($request);
        }

        $data       = $data->orderBy('date')->get();
        $file_name  = $this->reportFileName($request);
        $path       = public_path('storage/'. $file_name);

        $dompdf     = DomPdf::loadView('archive.report.print', [
            'type' => $request->type,
            'data' => $data,
            'ttd' => $this->petugasTtd(),
            'date_now' => to_indo_date(date('Y-m-d'), 1),
            'date_start' => to_indo_date($request->date_start),
            'date_end' => to_indo_date($request->date_end),
        ]);

        $dompdf->setPaper('F4', 'landscape');
        $dompdf->save($path);

        return redirect('storage/'. $file_name);
    }

    private function reportFileName($request)
    {
        $date_start = Carbon::parse($request->date_start)->format('d_m_Y');
        $date_end   = Carbon::parse($request->date_end)->format('d_m_Y');

        return 'Laporan_DPA_'. $date_start .'_sd_'. $date_end .'.pdf';
    }

    private function petugasTtd()
    {
        return PetugasTtd::where('type', 'arsip')->first();
    }
}
