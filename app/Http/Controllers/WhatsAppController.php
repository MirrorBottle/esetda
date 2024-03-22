<?php

namespace App\Http\Controllers;

use App\Jobs\SendWhatsAppFileJob;
use App\Jobs\SendWhatsAppJob;

class WhatsAppController extends Controller
{
    public function index()
    {
        // $data = [
        //     'template' => 'surat_terusan',
        //     'phone' => '6282255682584',
        //     'sender' => 'Operator Biro Hukum',
        //     'biro' => 'Biro Hukum',
        //     'title' => 'SURAT PENGADAAN BARANG DI DINAS KESEHATAN PROV. KALTIM',
        //     'category' => 'Surat Suap',
        //     'note' => 'tolong di segerakan kk',
        //     'url' => url('suap-gans'),
        // ];

        // SendWhatsAppJob::dispatch($data)->onQueue('notif_wa');
        $no_resi = unique_key();
        // $data_tamu = [
        //     'template' => 'surat_tamu',
        //     'phone' => '6282255682584',
        //     'pengirim' => 'UDING LAVENDOS',
        //     'instansi' => 'PERSIKAPAK KOTA SAMARINDA',
        //     'no_surat' => '189/X/I/2021',
        //     'tujuan' => 'GUBERNUR',
        //     'judul' => 'PERMOHONAN PAJAK KOTAK AMAL',
        //     'keterangan' => 'mohon izinnya slur',
        //     'no_wa' => '6282255682584',
        //     'no_resi' => $no_resi,
        // ];

        // test kirim status surat
        $data_surat = [
            'template' => 'cek_status',
            'code' => null,
            'phone' => '6285161318191',
            'instansi' => 'PERSIKAPAK KOTA SAMARINDA',
            'no_surat' => '101/X/I/2021',
            'dari' => 'BIRO UJI COBA',
            'tujuan' => 'GUBERNUR',
            'judul' => 'Mohon di segerakan pak gub',
            'status' => 'Perlu Disposisi',
            "tipe" => "new",
            'username' => auth()->user()->username ?? '-',
        ];

        SendWhatsAppJob::dispatch($data_surat)->onQueue('notif_wa');

        // $data_tamu['template'] = 'surat_tamu_validasi';
        // SendWhatsAppJob::dispatch($data_tamu)->onQueue('notif_wa');

        // $data_tamu['template'] = 'surat_tamu_tolak';
        // $data_tamu['validasi'] = 'Surat tidak sesuai standar pengetikan, harao di perbaiki';
        // SendWhatsAppJob::dispatch($data_tamu)->onQueue('notif_wa');

        dd('berhasil bro!');
    }

    public function image()
    {
        $data = [
            'type' => 'image',
            'phone' => '6282255682584',
            'message' => 'Uji coba mengirim gambar HD 2.6mb slur dari woo-wa',
            'file_url' => 'https://images.wallpapersden.com/image/download/greedfall-4k-8k-poster_a2ppZ2qUmZqaraWkpJRnamtlrWZpaWU.jpg'
        ];

        SendWhatsAppFileJob::dispatch($data)->onQueue('notif_wa');

        dd('Berhasil mengirim notif wa dalam bentuk gambar');
    }

    public function file()
    {
        $data = [
            'type' => 'file',
            'phone' => '6282255682584',
            'file_url' => 'https://sisda.kaltimprov.go.id/storage/inbox_31_08_2020_QmI5ucQKgU.pdf'
        ];

        SendWhatsAppFileJob::dispatch($data)->onQueue('notif_wa');

        dd('Berhasil mengirim notif wa dalam bentuk file');
    }

    private function templateSuratTerusan($data)
    {
        $message = '*-SURAT LINGKUP SETDA-*\n';
        $message .= 'Pengirim : '. $data['sender'] .'\n';
        $message .= 'Biro Pengirim : '. $data['biro'] .'\n';
        $message .= 'Judul : '. $data['title'] .'\n';
        $message .= 'Kategori Surat : '. $data['category'] .'\n\n';
        $message .= 'Klik untuk melihat '. $data['url'];

        return $message;
    }

    private function templatePeminjamanRuangan($data)
    {
        $message = '*-PEMINJAMAN RUANGAN-*\n';
        $message .= 'Nama : '. $data['name'] .'\n';
        $message .= 'Instansi : '. $data['institution'] .'\n';
        $message .= 'Ruangan : '. $data['room'] .'\n';
        $message .= 'Tanggal Pinjam : '. $data['date'] .'\n\n';
        $message .= 'Waktu Pinjam : '. $data['start_time'] .' s/d ' . $data['end_time'] .'\n\n';
        $message .= 'Klik untuk melihat '. $data['url'];

        return $message;
    }

    private function templateAgenda($agendas, $date)
    {
        $message = '*--AGENDA PIMPINAN--*\n';
        $message = 'Tanggal : '. $date;
        $message = '--------------------------------';

        foreach ($agendas as $data) {
            $message .= 'Yang menghadiri : '. $data['name'] .'\n';
            $message .= 'Jam Kegiatan : '. $data['start_time'] .' s/d ' . $data['end_time'] .'\n';
            $message .= 'Kegiatan : '. $data['event'] .'\n';
            $message .= 'Pakaian : '. $data['apparel'] .'\n\n';
            $message .= 'Tempat : '. $data['place']. '\n';
            $message .= 'Klik untuk melihat '. $data['url'];
            $message = '--------------------------------';
        }

        return $message;
    }

    /**
     * NOTIFIKASI WHATSAPP
     *
     * @param string $no WhatsApp Number
     * @param string $message Messages
     * @return boolean
    */
    private function notifWa($no, $message)
    {
        $key     = '50bb32900716aa4edfb35b6ae868dd1d086ce8270557c6d3';
        $url     = 'http://116.203.92.59/api/send_message';
        $data    = array("phone_no" => $no, "key" => $key, "message" => $message);
        $content = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
          'Content-Type: application/json',
          'Content-Length: ' . strlen($content))
        );

        $res = curl_exec($ch);
        curl_close($ch);

        return $res;
    }
}
