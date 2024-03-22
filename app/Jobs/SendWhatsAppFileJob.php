<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendWhatsAppFileJob implements ShouldQueue
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
        return $this->notifWaFile($this->data);
    }

    /**
     * NOTIFIKASI WHATSAPP
     *
     * @param string $no WhatsApp Number
     * @param string $message Messages
     * @return boolean
    */
    private function notifWaFile($format)
    {
        $route  = $format['type'] == 'image' ? 'send_image_url' : 'send_file_url';
        $key    = '50bb32900716aa4edfb35b6ae868dd1d086ce8270557c6d3';
        $url    = 'http://116.203.92.59/api/'. $route;
        $data   = [
            "phone_no" => $format['phone'],
            "key" => $key,
            "url" => $format['file_url'],
        ];

        if ($format['type'] == 'image') {
            $data["message"] = $format['message'];
        }

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

        return true;
    }
}
