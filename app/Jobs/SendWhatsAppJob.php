<?php

namespace App\Jobs;

use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class SendWhatsAppJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data  = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $username = $this->data["username"] ?? 'NULL';
        Log::info(">> Send Whatsapp to " . $this->data["phone"] . " with template " . $this->data["template"] . " by user " . $username);
        return $this->WoowaNotification($this->data["phone"], $this->selectMessageTemplate($this->data));
    }

    private function selectMessageTemplate($data)
    {
        if ($data["template"] == "surat_terusan") {
            $message = $this->templateSuratTerusan($data);
        } else if ($data["template"] == "peminjaman_ruangan") {
            $message = $this->templatePeminjamanRuangan($data);
        } else if ($data["template"] == "agenda") {
            $message = $this->templateAgenda($data);
        } else if ($data["template"] == "spt") {
            $message = $this->templateSpt($data);
        } else if ($data["template"] == "surat_tamu") {
            $message = $this->templateSuratTamu($data);
        } else if ($data["template"] == "surat_tamu_validasi") {
            $message = $this->templateSuratTamuValidasi($data);
        } else if ($data["template"] == "surat_tamu_tolak") {
            $message = $this->templateSuratTamuTolak($data);
        } else if ($data["template"] == "cek_status") {
            $message = $this->templateCekStatus($data);
        }

        return $message;
    }

    private function templateSuratTerusan($data)
    {
        $message = "*-SURAT LINGKUP SETDA-*\n";
        $message .= "Pengirim : " . $data["sender"] . "\n";
        $message .= "Biro Pengirim : " . $data["biro"] . "\n";
        $message .= "Judul : " . $data["title"] . "\n";
        $message .= "Kategori Surat : " . $data["category"] . "\n";
        $message .= "Keterangan Terusan: " . $data["note"] . "\n\n";
        $message .= "Klik untuk melihat " . $data["url"];

        return $message;
    }

    private function templatePeminjamanRuangan($data)
    {
        $message = "*-PEMINJAMAN RUANGAN-*\n";
        $message .= "Nama : " . $data["name"] . "\n";
        $message .= "Instansi : " . $data["institution"] . "\n";
        $message .= "Ruangan : " . $data["room"] . "\n";
        $message .= "Tanggal Pinjam : " . $data["date"] . "\n\n";
        $message .= "Waktu Pinjam : " . $data["start_time"] . " s/d " . $data["end_time"] . "\n\n";
        $message .= "Klik untuk melihat " . $data["url"];

        return $message;
    }

    private function templateAgenda($data)
    {
        if ($data["type"] == "update") {
            $type = "[UPDATE] ";
        } else if ($data["type"] == "reminder") {
            $type = "[REMINDER] ";
        } else {
            $type = "";
        }

        $message = "*" . $type . "AGENDA PIMPINAN*\n";
        $message .= "*_Tanggal : " . $data["date"] . "_*\n\n";

        foreach ($data["agendas"] as $agenda) {
            $message .= "Dihadiri Oleh : *" . $agenda["name"] . "*\n";
            $message .= "Jam Kegiatan : " . $agenda["start_time"] . " s/d " . $agenda["end_time"] . "\n";
            $message .= "Kegiatan : " . $agenda["event"] . "\n";
            $message .= "Pakaian : " . $agenda["apparel"] . "\n";
            $message .= "Tempat : " . $agenda["place"] . "\n";
            $message .= "Lampiran: " . $agenda["attachment"] . "\n\n";
            $message .= "Keterangan : \n" . $agenda["note"] . "\n";
            $message .= "----------------------------------------------\n";
        }

        return $message;
    }

    private function templateSuratTamu($data)
    {
        $message = "Terimakasih telah menggunakan aplikasi OPTIKSIDA\n";
        $message .= "Berikut data surat yang anda kirimkan ke Kantor Gubernur :\n\n";

        $message .= $this->templateSuratTamuGlobal($data);

        $message .= "Untuk melihat status surat yang dikirim, bisa membalas pesan ini dengan mengetik \"*CEK (masukan nomor resi surat)\"* tanpa tanda kutip";

        return $message;
    }

    private function templateSuratTamuValidasi($data)
    {
        $message = "*SURAT MASUK ONLINE*\n";
        $message .= "*---------------------------*\n\n";

        $message .= $this->templateSuratTamuGlobal($data);

        $message .= "Mohon untuk memvalidasi surat pada surat masuk online. Terimakasih.";

        return $message;
    }

    private function templateSuratTamuTolak($data)
    {
        $message = "Mohon maaf, surat yang anda kirimkan melalui website tidak valid / tidak lengkap.\n\n";

        $message .= $this->templateSuratTamuGlobal($data, true);

        return $message;
    }

    private function templateSuratTamuGlobal($data, $is_invalid = false)
    {
        $message = "";
        $message .= "Nama Pengirim : " . $data["pengirim"] . "\n";
        $message .= "Instansi: " . $data["instansi"] . "\n";
        $message .= "Nomor Surat : " . $data["no_surat"] . "\n";
        $message .= "Tujuan Surat : " . $data["tujuan"] . "\n";
        $message .= "Judul Surat : " . $data["judul"] . "\n";
        $message .= "Keterangan : " . $data["keterangan"] . "\n";
        $message .= "Nomor Whatsapp : " . $data["no_wa"] . "\n";
        $message .= "Nomor Resi Surat : *" . $data["no_resi"] . "*\n";
        if ($is_invalid) {
            $message .= "Keterangan Validasi : *" . $data["validasi"] . "*\n";
        } else {
            $message .= "\n";
        }

        return $message;
    }

    private function templateCekStatus($data)
    {
        $message = "*Informasi Surat*\n";
        if ($data["tipe"] == "update") {
            $message = "*[UPDATE] Informasi Surat*\n";
        }

        if ($data["code"] !== null) {
            $message .= "Nomor Resi Surat : *" . $data["code"] . "*\n";
        }
        $message .= "--------------------------------------------------------------\n";
        $message .= "Instansi : " . $data["instansi"] . "\n";
        $message .= "Nomor Surat : " . $data["no_surat"] . "\n";
        $message .= "Dari : " . $data["dari"] . "\n";
        $message .= "Tujuan : " . $data["tujuan"] . "\n";
        $message .= "Judul Surat : " . $data["judul"] . "\n";
        $message .= "Status Surat : " . $data["status"] . "\n";

        return $message;
    }

    private function templateSpt($data)
    {
        return $data["message"];
    }

    /**
     * WOOWA SERVICE NOTIFICATION
     *
     * @param string $phone_number WhatsApp Number
     * @param string $message Messages
     * @return boolean
     */
    private function WoowaNotification($phone_number = "", $message)
    {
        $route      = $phone_number === "" ? '/async_send_message_group_id' : '/async_send_message';
        $recipient  = $phone_number === "" ? env('WOOWA_GROUP_ID') : $phone_number;
        $url        = env('WOOWA_API_URL') . $route;
        $key        = env('WOOWA_API_KEY');

        $body       = ["phone_no" => $recipient, "key" => $key, "message" => $message];
        if ($phone_number == "") {
            $body   = ["group_id" => $recipient, "key" => $key, "message" => $message];
        }

        $client     = new Client();
        $response   = $client->request('POST', $url, ['json' => $body]);
        Log::info(">> Send Whatsapp to " . $recipient);
        return $response->getStatusCode() === 200;
    }
}
