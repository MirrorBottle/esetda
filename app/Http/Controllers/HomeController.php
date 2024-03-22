<?php

namespace App\Http\Controllers;

use Auth;
use App\Inbox;
use App\Outbox;
use App\Forward;
use App\Agenda;
use App\ArchiveInfo;
use App\Biro;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if ( Auth::check() ) {
            return redirect('/dashboard');
        }

        return redirect('/login');
        // return view('welcome');
    }

    /**
     * Show the php information.
     *
     * @return void
     */
    public function info()
    {
        echo phpinfo();
    }

    public function dashboard()
    {
        $data = array();
        $user_type = auth()->user()->type_formatted;
        if ($user_type == 'esetda') {
            $month_name = $this->defaultMonthNumber();
            $charts = ['inbox' => $month_name, 'outbox' => $month_name, 'forward' => $month_name];

            $inboxes = Inbox::filterBiro()
                ->select(DB::raw('count(id) as `total`'), DB::raw("MONTH(date_entry) as month"))
                ->whereYear('date_entry', date('Y'))
                ->groupby('month')
                ->get();

            $outboxes = Outbox::filterBiro()
                ->select(DB::raw('count(id) as `total`'), DB::raw("MONTH(date_entry) as month"))
                ->whereYear('date_entry', date('Y'))
                ->groupby('month')
                ->get();

            $forwards = Forward::filterBiro()
                ->select(DB::raw('count(id) as `total`'), DB::raw("MONTH(created_at) as month"))
                ->whereYear('created_at', date('Y'))
                ->groupby('month')
                ->get();

            foreach ($inboxes as $inbox) {
                $charts['inbox'][$inbox->month] = $inbox->total;
            }

            foreach ($outboxes as $outbox) {
                $charts['outbox'][$outbox->month] = $outbox->total;
            }

            foreach ($forwards as $forward) {
                $charts['forward'][$forward->month] = $forward->total;
            }

            $data = [
                'surat_masuk' => Inbox::filterBiro()->whereYear('date_entry', date('Y'))->count() ?? 0,
                'surat_keluar' => Outbox::filterBiro()->whereYear('date_entry', date('Y'))->count() ?? 0,
                'surat_terusan' => Forward::filterBiro()->whereYear('created_at', date('Y'))->count() ?? 0,
                'charts' => $charts,
                'months' => $this->monthsList(),
            ];
        } else if ($user_type == 'earsip') {
            $inbox = ArchiveInfo::filterBiro()->inbox()->where('is_archived', 0)->get();
            $outbox = ArchiveInfo::filterBiro()->outbox()->where('is_archived', 0)->get();
            $data = [
                'all' => 90,
                'monthly' => 10,
                'inbox' => $inbox,
                'outbox' => $outbox,
            ];
        } else if ($user_type == 'eagenda') {
            $data = ['agendas' => $this->latestAgenda()];
        } else if ($user_type == 'super') {
            $charts = array();
            foreach (Biro::all() as $biro) {
                $charts[$biro->id] = [
                    'name' => $biro->name,
                    'inbox' => 0,
                    'outbox' => 0,
                    'forward' => 0,
                ];
            }

            $year     = request()->year ?? date('Y');
            $inboxes  = Inbox::whereYear('date_entry', $year);
            $outboxes = Outbox::whereYear('date_entry', $year);
            $forwards = Forward::whereYear('created_at', $year);

            foreach ($inboxes->get() as $inbox) {
                $charts[$inbox->biro_id]['inbox']++;
            }

            foreach ($outboxes->get() as $outbox) {
                $charts[$outbox->biro_id]['outbox']++;
            }

            foreach ($forwards->get() as $forward) {
                $charts[1]['forward']++;
            }

            // reformat data to charts format
            $reformat = ['inbox' => [], 'outbox' => [], 'forward' => []];
            foreach ($charts as $chart) {
                $reformat['inbox'][] = $chart['inbox'];
                $reformat['outbox'][] = $chart['outbox'];
                $reformat['forward'][] = $chart['forward'];
            }

            $data = [
                'surat_masuk' => $inboxes->count() ?? 0,
                'surat_keluar' => $outboxes->count() ?? 0,
                'surat_terusan' => $forwards->count() ?? 0,
                'charts' => $reformat,
                'biros' => Biro::pluck('alias')->toArray(),
            ];
        }

        return view('admin.dashboard.index', compact('user_type', 'data'));
    }

    private function latestAgenda()
    {
        $username = auth()->user()->username;
        if ($username == 'agenda_gub') {
            $receiver_id = 1;
        } else if ($username == 'agenda_wagub') {
            $receiver_id = 2;
        } else if ($username == 'agenda_sekda') {
            $receiver_id = 3;
        } else {
            return Agenda::whereDate('date', date('Y-m-d'))
                ->orderBy('time_start')
                ->get();
        }

        return Agenda::where('receiver_id', $receiver_id)
            ->whereDate('date', date('Y-m-d'))
            ->orderBy('time_start')
            ->get();
    }

    private function defaultMonthNumber()
    {
        return [1 => 0, 2 => 0, 3 => 0, 4 => 0, 5 => 0, 6 => 0, 7 => 0, 8 => 0, 9 => 0, 10 => 0, 11 => 0, 12 => 0];
    }

    private function monthsList()
    {
        return [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    }
}
