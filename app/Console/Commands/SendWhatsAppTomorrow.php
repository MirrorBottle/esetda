<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendWhatsAppJob;
use App\Agenda;
use Carbon\Carbon;

class SendWhatsAppTomorrow extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notif:wa_next';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Next Agenda Reminder - WhatsApp Notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $agendas  = $this->agendaData();
        if ($agendas->isEmpty()) {
            $this->info("Tidak ada data agenda untuk esok hari.");
            return false;
        }

        foreach ($agendas as $agenda) {
            $this->sendWhatsAppBot($agenda);
        }

        $this->info("Berhasil mengirim notifikasi agenda esok hari");
    }

    private function agendaData()
    {
        $today = Carbon::now();
        $next  = $today->copy()->addDay(1);

        return Agenda::whereDate('date', $next->format('Y-m-d'))
            ->orderBy('time_start')
            ->orderBy('time_end')
            ->get();
    }

    private function sendWhatsAppBot($agenda)
    {
        $shortlink = $agenda->is_attachment ? $agenda->shortlink : '-';

        $data = [
            'type' => 'reminder',
            'username' => auth()->user()->username ?? '-',
            'phone' => '',
            'template' => 'agenda',
            'date' => $agenda->date_indo,
            'agendas' => [
                [
                    'name' => $agenda->receiver->name ?? '-',
                    'start_time' => $agenda->time_start ?? '-',
                    'end_time' => $agenda->time_end ?? '-',
                    'event' => $agenda->event ?? '-',
                    'apparel' => $agenda->apparel->name ?? '-',
                    'place' => $agenda->place->name ?? '-',
                    'note' => $agenda->description ?? '-',
                    'attachment' => $shortlink
                ]
            ]
        ];

        SendWhatsAppJob::dispatch($data)->onQueue('notif_wa');
    }
}
