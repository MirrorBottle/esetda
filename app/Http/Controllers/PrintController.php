<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kop;
use App\Pejabat;
use App\Inbox;
use App\Outbox;
use App\Receiver;
use App\Disposition;
use App\DispositionAdmin;
use App\PetugasTtd;
use App\User;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use DomPdf;

class PrintController extends Controller
{
    public function index(Request $request)
    {
        $receivers = Receiver::get(['id', 'name', 'type']);
        $date = to_indo_day(date('N')) . ', ' . to_indo_date(date('Y-m-d'), 1);

        return view('report.index', compact('date', 'receivers'));
    }

    public function disposisi(Request $request)
    {
        if ($request->type == 'add') {
            $disposition = Disposition::create($request->all());
        } else {
            $date_time_receipt = $this->checkDateTimeReceipt($request);
            $disposition = Disposition::findOrFail($request->id);
            $disposition->update([
                'kop' => $request->kop,
                'ttd' => $request->ttd,
                'property' => $request->property,
                'sender' => $request->sender,
                'date_time_receipt' => $date_time_receipt,
                'description' => $request->description,
                'is_ttd' => $request->is_ttd ?? 1,
            ]);
        }

        $kop_id     = $request->kop == '0' ? 2 : 1;
        $inbox      = Inbox::findOrFail($request->inbox_id);
        $file_name  = $this->disposisiFileName($request->no_letter);
        $path       = public_path('storage/' . $file_name);
        $data       = [
            'no' => $inbox->no,
            'data' => $request->all(),
            'kop' => Kop::find($kop_id),
            'custom' => $this->customData($request)
        ];

        return view('print.disposisi', $data);
        // $dompdf = DomPdf::loadView('print.disposisi', $data);
        // $dompdf->setPaper('A5');
        // $dompdf->save($path);

        // return redirect('storage/'. $file_name);
    }

    public function disposisiAdmin($inbox_id)
    {
        if (request()->has('user_id')) {
            $user = User::findOrFail(request()->user_id);
        } else {
            $user = auth()->user();
        }

        $kop_id = 3;
        $is_gub_receiver = [1, 2, 1980];
        $inbox = Inbox::with('visitor')
            ->with('disposition')
            ->with('receiver')
            ->findOrFail($inbox_id);

        $no_agenda = $inbox->disposition->no_agenda ?? '-';
        $sifat = $inbox->disposition->property_formatted ?? '-';

        if ($inbox->visitor_id !== null) {
            $no_agenda = $inbox->visitor->no_agenda ?? '-';
            $sifat = $inbox->visitor->property_formatted ?? '-';
        }

        if (in_array($inbox->receiver_id, $is_gub_receiver)) {
            $kop_id = 1;
        }

        $pejabat = $user->pejabat;
        if ($pejabat === null) {
            if ($user->username == 'tu_pimpinan') {
                $user_gub = User::where('type', 0)->where('receiver_id', $inbox->receiver_id)->first();
                $pejabat = $user_gub->pejabat ?? null;
                $user = $user_gub;
            }

            $user_karo = User::where('username', 'like', '%karo%')->where('biro_id', $user->biro_id)->first();
            if ($user_karo != null) {
                $pejabat = $user_karo->pejabat ?? null;
                $user = $user_karo;
            }
        }

        $disposition_admin = DispositionAdmin::where('user_id', $user->id)
            ->where('unique_key', $inbox->unique_key)
            ->first();

        $created_at_data = explode(" ", ($inbox->created_at ?? date('Y-m-d H:i:s')));
        $date_receipt = $created_at_data[0];
        $time_receipt = substr($created_at_data[1], 0, 5) . ' WITA';
        $disposisi_item = [
            1 => 'Proses lebih lanjut',
            'Tanggapan dan saran',
            'Jadwalkan',
            'Wakili/Dampingi',
            'Siapkan Bahan/Pointer',
            'Koordinasikan',
        ];

        $data = [
            'inbox'          => $inbox,
            'kop_id'         => $kop_id,
            'kop'            => Kop::find($kop_id),
            'title'          => $pejabat->title ?? '',
            'position'       => $pejabat->position ?? '',
            'name'           => $pejabat->name ?? '',
            'date'           => to_indo_date($inbox->date, 1),
            'date_receipt'   => to_indo_date($date_receipt, 1),
            'property'       => $sifat,
            'no_agenda'      => $no_agenda,
            'time'           => $time_receipt,
            'disposisi'      => $disposition_admin,
            'disposisi_item' => $disposisi_item,
            'user'           => $user,
            'square_blank'   => image_to_base64('images/square-black.png'),
            'square_check'   => image_to_base64('images/square-check-black.png')
        ];

        // generate pdf after disposition
        // if ($disposition_admin !== null) {
        //     if ($disposition_admin->print_attachment === null) {
        //         $file_name = 'Disposisi_Surat_'. $disposition_admin->id .''. $disposition_admin->created_at->format('dmYHis'). '.pdf';
        //         $path = public_path('storage/'. $file_name);
        //         $dompdf = DomPdf::loadView('print.disposisi_admin', $data);
        //         $dompdf->save($path);

        //         $disposition_admin->update(['print_attachment' => $file_name]);
        //     }

        //     // return view('print.disposisi_admin', $data);

        //     return redirect('storage/'. $disposition_admin->print_attachment);
        // }

        // print html preview
        return view('print.disposisi_admin', $data);
    }

    private function reportExcel($data) {
        $date = $data['date'];
        $total_receiver = $data['total_receiver'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(storage_path('template/laporan_surat.xlsx'));
        $sheet = $spreadsheet->setActiveSheetIndex(0);

        // * SET HEADER
        $sheet->setCellValue("A3", "Laporan Surat " . $data['type']);
        $sheet->getStyle("A3")->getFont()->setSize(14);
        $sheet->getStyle("A3")->getFont()->setName('Arial');

        // * SET BODY
        $row = 5;
        foreach($data['data'] as $key => $item) {
            $sheet->setCellValue("A$row", $key + 1);
            $sheet->setCellValue("B$row", $item->no);
            if(empty($total_receiver) || $total_receiver > 1) {
                if(auth()->user()->biro_id == 1) {
                    $sheet->setCellValue("C$row", $item->receiver->name);
                }
            }
            if(auth()->user()->type_formatted === 'super') {
                $sheet->setCellValue("C$row", $item->receiver->name);
            }
            $sheet->setCellValue("D$row", $item->title);
            $sheet->setCellValue("E$row", $item->category->name);
            $sheet->setCellValue("F$row", $item->date_formatted);
            $sheet->setCellValue("G$row", $item->date_entry_formatted);
            $sheet->setCellValue("H$row", $item->description);

            $sheet->getStyle("A$row:H$row")->getFont()->setSize(12);
            $sheet->getStyle("A$row:H$row")->getFont()->setName('Arial MT');
            $sheet->getStyle("A$row:H$row")->getAlignment()->setWrapText(true);
            $sheet->getStyle("A$row:H$row")->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

            $sheet->getStyle("A$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("E$row")->getAlignment()->setHorizontal('center');

            $row++;
        }
        $row = $row + 2;
        // * SET FOOTER
        $sheet->setCellValue("F$row", "$date\nANALIS KEBIJAKAN AHLI MUDA\n( PERSURATAN DAN ARSIP)");
        $sheet->getStyle("F$row")->getFont()->setSize(12);
        $sheet->getStyle("F$row")->getFont()->setName('Arial MT');
        $sheet->mergeCells("F$row:H$row");
        $sheet->getStyle("F$row:H$row")->getAlignment()->setWrapText(true);
        $sheet->getStyle("F$row:H$row")->getAlignment()->setHorizontal('center');

        $sheet->getRowDimension($row)->setRowHeight(55);
        $row++;
        $sheet->setCellValue("F$row", "HELDI, SE PENATA Tk.I\nNIP. 19670311 199002 1004");
        $sheet->getStyle("F$row")->getFont()->setSize(12);
        $sheet->getStyle("F$row")->getFont()->setName('Arial MT');
        $nextRow = $row + 1;
        $sheet->mergeCells("F$row:H$nextRow");
        $sheet->getStyle("F$row:H$nextRow")->getAlignment()->setWrapText(true);
        $sheet->getStyle("F$row:H$nextRow")->getAlignment()->setHorizontal('center');

        header('Content-Disposition: attachment;filename="' . $data['file_name']);
        $writer = new Xls($spreadsheet);
        $writer->save('php://output');
    }

    public function report(Request $request)
    {
        $kop_id     = 3;
        $model      = $request->type == 'masuk' ? Inbox::class : Outbox::class;
        $data       = $this->filterReport($model, $request);
        $file_name  = $this->reportFileName($request, $request->file_type == 'pdf' ? 'pdf' : 'xls');
        $path       = public_path('storage/' . $file_name);
        $date       = Carbon::now();
        $data       = [
            'data' => $data,
            'kop' => Kop::find($kop_id),
            'type' => ucfirst($request->type),
            'date' => to_indo_date($date->format('Y-m-d'), 1),
            'total_receiver' => count($request->receiver_id ?? []),
            'date_start' => to_indo_date($request->date_start ?? date('Y-m-d'), 2, '_'),
            'date_end' => to_indo_date($request->date_end ?? date('Y-m-d'), 2, '_'),
            'file_name' => $file_name,
            'petugas' => $this->petugasTtdBiro()
        ];
        if($request->file_type == 'pdf') {
            return view('print.report', $data);
        } else {
            return $this->reportExcel($data);
        }


        // jika kosong tampilkan view pesan tidak ada data
        // if ($data['data']->isEmpty()) { return view('print.report', $data); }

        // $dompdf = DomPdf::loadView('print.report', $data);
        // $dompdf->setPaper('a4', 'landscape');
        // $dompdf->save($path);

        // return redirect('storage/'. $file_name);
    }

    private function disposisiFileName($no_surat)
    {
        $biro     = auth()->user()->biro->name;
        $biro     = str_replace(' ', '_', $biro);
        $no_surat = preg_replace("/&#?[a-z0-9]+;/i", "_", $no_surat);
        $no_surat = str_replace('/', '_', $no_surat);

        return 'Disposisi_No_' . $no_surat . '_' . $biro . '.pdf';
    }

    private function reportFileName($request, $ext)
    {
        $biro       = auth()->user()->biro->name ?? auth()->user()->username;
        $biro       = str_replace(' ', '_', $biro);
        $type       = ucfirst($request->type);
        $date_start = Carbon::parse($request->date_start)->format('d_m_Y');
        $date_end   = Carbon::parse($request->date_end)->format('d_m_Y');

        return 'Laporan_Surat_' . $type . '_' . $date_start . '_sd_' . $date_end . '_' . $biro . '.' . $ext;
    }

    private function filterReport($model, $request)
    {
        $biro_id = auth()->user()->biro_id;
        if ($biro_id === null) {
            //  filter id tujuan per username admin
            $receiver_id = auth()->user()->receiver_id;
            $query = $model::filter($request)->where('receiver_id', $receiver_id);
        } else {
            $query = $model::filter($request)->where('biro_id', $biro_id);
        }
        if ($request->has('multi_receiver_id')) {
            $query->whereIn('receiver_id', $request->multi_receiver_id);
        }

        return $query->orderBy('id', 'desc')->get();
    }

    private function customData($request)
    {
        $pejabat = Pejabat::find($request->kop);
        if ($request->kop == '0') {
            $pejabat = Pejabat::find($request->ttd);
        }

        if ($request->property == '1') {
            $property = "Segera";
        } else if ($request->property == '2') {
            $property = "Rahasia";
        } else {
            $property = "Sangat Segera";
        }

        $time           = $request->time_receipt ?? '';
        $title          = $pejabat->title;
        $position       = $pejabat->position;
        $name           = $pejabat->name;
        $date           = to_indo_date($request->date ?? date('Y-m-d'), 1);
        $date_receipt   = $request->hidden_date_receipt == null ? '' : to_indo_date($request->date_receipt, 1);
        $ttd_area       = $request->is_ttd ?? 1;

        return compact('title', 'position', 'name', 'property', 'time', 'date', 'date_receipt', 'ttd_area');
    }

    private function checkDateTimeReceipt($request)
    {
        if ($request->hidden_date_receipt === null) {
            return null;
        }
        if ($request->time_receipt === null) {
            return $request->date_receipt . ' 00:00';
        }

        return $request->date_receipt . ' ' . $request->time_receipt;
    }

    private function petugasTtdBiro()
    {
        $slug = auth()->user()->biro->slug ?? null;
        if ($slug == null) {
            return null;
        }
        return PetugasTtd::where('type', $slug)->first();
    }
}
