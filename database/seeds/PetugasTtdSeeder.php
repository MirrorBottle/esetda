<?php

use App\PetugasTtd;
use Illuminate\Database\Seeder;

class PetugasTtdSeeder extends Seeder
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
                'type' => 'arsip',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN TATA USAHA UMUM',
            ],
            [
                'type' => 'agenda',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN TATA USAHA UMUM',
            ],
            [
                'type' => 'tu-pimpinan',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN TU PIMPINAN'
            ],
            [
                'type' => 'biro-umum',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO UMUM'
            ],
            [
                'type' => 'biro-hukum',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO HUKUM'
            ],
            [
                'type' => 'biro-perekonomian',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO PEREKENOMIAN'
            ],
            [
                'type' => 'biro-kesra',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN KESRA'
            ],
            [
                'type' => 'biro-adpim',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO ADPIM'
            ],
            [
                'type' => 'biro-organisasi',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO ORGANISASI'
            ],
            [
                'type' => 'biro-adbang',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO ADBANG'
            ],
            [
                'type' => 'biro-ppod',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO PPOD'
            ],
            [
                'type' => 'biro-isd',
                'name' => 'H. IMANUDDIN, SH., MM',
                'title' => 'KEPALA BAGIAN BIRO ISD'
            ]
        ];

        PetugasTtd::insert($data);
    }
}
