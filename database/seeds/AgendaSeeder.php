<?php

use Illuminate\Database\Seeder;
use App\Agenda;
use App\AgendaApparel;
use App\AgendaDisposition;
use App\AgendaPartner;
use App\AgendaPlace;
use App\AgendaReceiver;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // apparel data
        $data_apparel = [
            ['name' => 'Menyesuaikan'],
            ['name' => 'Muslim'],
            ['name' => 'Batik'],
            ['name' => 'Beskab'],
            ['name' => 'PSL'],
            ['name' => 'Korpri'],
            ['name' => 'Olahraga'],
        ];

        AgendaApparel::insert($data_apparel);

        // disposition data
        $data_disposition = [
            ['position' => 'Presiden RI'],
            ['position' => 'Gubernur'],
            ['position' => 'Wakil Gubernur'],
            ['position' => 'PM'],
            ['position' => 'Assisten I'],
            ['position' => 'Assisten II'],
            ['position' => 'Assisten III'],
            ['position' => 'Plt. Sekda'],
            ['position' => 'Plt. Assisten I'],
            ['position' => 'Plt. Assisten II'],
            ['position' => 'Plt. Assisten III'],
        ];

        AgendaDisposition::insert($data_disposition);

        // partner data
        $data_partner = [
            ['position' => 'PM'],
            ['position' => 'Walikota'],
            ['position' => 'Bupati'],
            ['position' => 'Karo Umum'],
            ['position' => 'Karo Kesra'],
            ['position' => 'Karo Adpim'],
            ['position' => 'Karo Keuangan'],
            ['position' => 'FKP'],
            ['position' => 'OPD'],
        ];

        AgendaPartner::insert($data_partner);

        // place data
        $data_place = [
            ['name' => 'Terminal Bandara APT SMD'],
            ['name' => 'Ruang Ruhui Rahayu'],
            ['name' => 'Gor Sempaja'],
            ['name' => 'Gor Segiri'],
            ['name' => 'Kantor Gubernur'],
            ['name' => 'Gedung DPRD Provinsi'],
        ];

        Agendaplace::insert($data_place);

        // place data
        $data_receiver = [
            ['name' => 'GUBERNUR', 'code' => 'gub'],
            ['name' => 'WAKIL GUBERNUR', 'code' => 'wagub'],
            ['name' => 'SEKRETARIS DAERAH', 'code' => 'sekda'],
            ['name' => 'ASSISTEN PEMERINTAHAN DAN KESRA', 'code' => 'asis1'],
            ['name' => 'ASSISTEN PEREKONOMIAN DAN ADMINISTRASI PEMBANGUNAN', 'code' => 'asis2'],
            ['name' => 'ASSISTEN ADMINISTRASI UMUM', 'code' => 'asis3'],
            ['name' => 'STAFF AHLI GUBERNUR', 'code' => 'staff-ahli'],
            ['name' => 'BIRO KESRA', 'code' => 'biro-kesra'],
            ['name' => 'BIRO PEMERINTAHAN PERBATASAN DAN OTDA', 'code' => 'biro-ppod'],
            ['name' => 'BIRO HUKUM', 'code' => 'biro-hukum'],
            ['name' => 'BIRO PEREKONOMIAN', 'code' => 'biro-ekonomi'],
            ['name' => 'BIRO INFRASTRUKTUR DAN SUMBER DAYA', 'code' => 'biro-infra'],
            ['name' => 'BIRO ADMINISTRASI PEMBANGUNAN', 'code' => 'biro-adm'],
            ['name' => 'BIRO ORGANISASI', 'code' => 'biro-org'],
            ['name' => 'BIRO UMUM', 'code' => 'biro-umum'],
            ['name' => 'BIRO ADMINISTRASI PIMPINAN', 'code' => 'biro-adpim'],
        ];

        AgendaReceiver::insert($data_receiver);

        // agenda data
        $date = \Carbon\Carbon::now();
        $dummy_events = [
            'Peresmian',
            'Pelantikan',
            'Pertemuan',
            'Peringatan',
            'Peninjauan',
            'Serah Terima',
            'Hari Jadi',
        ];

        // foreach (range(1, 20) as $index) {
        //     $event = $dummy_events[rand(0, 6)];
        //     $agenda = Agenda::create([
        //         'date' => $date->copy()->addDays($index)->format('Y-m-d'),
        //         'time_start' => rand(8, 12).':00',
        //         'time_end' =>  rand(13, 20).':00',
        //         'event' => $event .' #'. $index,
        //         'place_id' => rand(1, 6),
        //         'apparel_id' => rand(1, 7),
        //         'disposition_id' => rand(1, 11),
        //         'receiver_id' => rand(1, 16),
        //         'status' => rand(0, 1),
        //         'description' => 'Penanggung Jawab '. $event .' #'. $index
        //     ]);

        //     // insert agenda partner detail
        //     $partner_detail = array();
        //     foreach (range(1, rand(2, 3)) as $sub_index) {
        //         $partner_detail[] = AgendaPartner::find($sub_index);
        //     }

        //     $agenda->partners()->saveMany($partner_detail);
        // }

        // foreach (range(1, 10) as $index) {
        //     $event = $dummy_events[rand(0, 6)];
        //     $agenda = Agenda::create([
        //         'date' => $date->copy()->format('Y-m-d'),
        //         'time_start' => rand(8, 12).':00',
        //         'time_end' =>  rand(13, 20).':00',
        //         'event' => $event .' #'. $index,
        //         'place_id' => rand(1, 6),
        //         'apparel_id' => rand(1, 7),
        //         'disposition_id' => rand(1, 11),
        //         'receiver_id' => rand(1, 16),
        //         'status' => rand(0, 1),
        //         'description' => 'Penanggung Jawab '. $event .' #'. $index
        //     ]);

        //     // insert agenda partner detail
        //     $partner_detail = array();
        //     foreach (range(1, rand(2, 3)) as $sub_index) {
        //         $partner_detail[] = AgendaPartner::find($sub_index);
        //     }

        //     $agenda->partners()->saveMany($partner_detail);
        // }
    }
}
