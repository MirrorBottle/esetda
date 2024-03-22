<?php

use Illuminate\Database\Seeder;

class PejabatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'ISRAN NOOR',
                'title' => 'GUBERNUR',
                'position' => 'GUBERNUR',
                'type' => 1,
                'is_active' => 1,
                'is_ttd_area' => 1,
                'user_id' => 42,
            ],
            [
                'name' => 'HADI MULYADI',
                'title' => 'WAKIL GUBERNUR',
                'position' => 'WAKIL GUBERNUR',
                'type' => 1,
                'is_active' => 1,
                'is_ttd_area' => 1,
                'user_id' => 43,
            ],
            [
                'name' => 'MUHAMMAD SA\'BANI',
                'title' => 'SEKDA',
                'position' => 'PLT. SEKRETARIS DAERAH',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 1,
                'user_id' => 44,
            ],
            [
                'name' => 'ABU HELMI',
                'title' => 'ASISTEN II',
                'position' => 'ASISTEN II',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 47,
            ],
            [
                'name' => 'FATHUL HALIM',
                'title' => 'ASISTEN III',
                'position' => 'ASISTEN III',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 48,
            ],
            [
                'name' => 'MOH. JAUHAR EFFENDI',
                'title' => 'PLT. ASISTEN I',
                'position' => 'PLT. ASISTEN I',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 46,
            ],
            [
                'name' => 'Dra. Hj. Norhayati US, M.Si',
                'title' => 'KEPALA BIRO UMUM',
                'position' => 'KEPALA BIRO UMUM',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 7,
            ],
            [
                'name' => 'IR. HJ. LISA HASLIANA, M. SI',
                'title' => 'KEPALA BIRO ISD',
                'position' => 'KEPALA BIRO ISD',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 31,
            ],
            [
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'STAFF AHLI BIDANG',
                'position' => 'STAFF AHLI BIDANG',
                'type' => 0,
                'is_active' => 1,
                'is_ttd_area' => 0,
                'user_id' => 45,
            ],
        ];

        \App\Pejabat::insert($data);
    }
}
