<?php

use Illuminate\Database\Seeder;
use App\Receiver;

class ReceiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // lingkup setda
        $data = [
            ['name' => 'GUBERNUR', 'type' => 1, 'biro_id' => null],
            ['name' => 'WAKIL GUBERNUR', 'type' => 1, 'biro_id' => null],
            ['name' => 'SEKRETARIS DAERAH', 'type' => 1, 'biro_id' => null],
            ['name' => 'STAFF AHLI BIDANG', 'type' => 2, 'biro_id' => null],
            ['name' => 'ASSISTEN PEMERINTAHAN DAN KESRA', 'type' => 1, 'biro_id' => null],
            ['name' => 'ASSISTEN PEREKONOMIAN DAN ADMINISTRASI PEMBANGUNAN', 'type' => 1, 'biro_id' => null],
            ['name' => 'ASSISTEN ADMINISTRASI UMUM', 'type' => 1, 'biro_id' => null],
            ['name' => 'BIRO KESRA', 'type' => 1, 'biro_id' => 5],
            ['name' => 'BIRO PEMERINTAHAN PERBATASAN DAN OTDA', 'type' => 1, 'biro_id' => 9],
            ['name' => 'BIRO HUKUM', 'type' => 1, 'biro_id' => 3],
            ['name' => 'BIRO PEREKONOMIAN', 'type' => 1, 'biro_id' => 4],
            ['name' => 'BIRO INFRASTRUKTUR DAN SUMBER DAYA', 'type' => 1, 'biro_id' => 10],
            ['name' => 'BIRO ADMINISTRASI PEMBANGUNAN', 'type' => 1, 'biro_id' => 8],
            ['name' => 'BIRO ORGANISASI', 'type' => 1, 'biro_id' => 7],
            ['name' => 'BIRO UMUM', 'type' => 1, 'biro_id' => 2],
            ['name' => 'BIRO ADMINISTRASI PIMPINAN', 'type' => 1, 'biro_id' => 6],
        ];

        Receiver::insert($data);

        // luar setda
        $data_luar = [
            ['name' => 'BPKAD KALTIM', 'type' => 0, 'biro_id' => null],
            ['name' => 'DINAS PENDIDIKAN KALTIM', 'type' => 0, 'biro_id' => null],
            ['name' => 'DINAS KESEHATAN KALTIM', 'type' => 0, 'biro_id' => null],
        ];

        Receiver::insert($data_luar);

        // internal/view only
        $data_view = [
            ['name' => 'KEPALA BADAN', 'type' => 2, 'biro_id' => null],
            ['name' => 'KEPALA DINAS', 'type' => 2, 'biro_id' => null],
            ['name' => 'KA INSPEKTORAT', 'type' => 2, 'biro_id' => null],
            // ['name' => 'KASUBAG TU PIMPINAN', 'type' => 2, 'biro_id' => null],
            ['name' => 'PROTOKOL', 'type' => 2, 'biro_id' => null],
            ['name' => 'KABAG ', 'type' => 2, 'biro_id' => null],
            ['name' => 'KASUBAG ', 'type' => 2, 'biro_id' => null],
        ];

        Receiver::insert($data_view);
    }
}
