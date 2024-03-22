<?php

use Illuminate\Database\Seeder;
use App\Biro;

class BiroSeeder extends Seeder
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
                'name' => 'Biro Umum (TU. Pimpinan)',
                'alias' => 'TU. Pimpinan',
                'slug' => 'tu-pimpinan'
            ],
            [
                'name' => 'Biro Umum',
                'alias' => 'Biro Umum',
                'slug' => 'biro-umum'
            ],
            [
                'name' => 'Biro Hukum',
                'alias' => 'Biro Hukum',
                'slug' => 'biro-hukum'
            ],
            [
                'name' => 'Biro Perekonomian',
                'alias' => 'Biro Perekonomian',
                'slug' => 'biro-perekonomian'
            ],
            [
                'name' => 'Biro Kesra',
                'alias' => 'Biro Kesra',
                'slug' => 'biro-kesra'
            ],
            [
                'name' => 'Biro Adpim',
                'alias' => 'Biro Adpim',
                'slug' => 'biro-adpim'
            ],
            [
                'name' => 'Biro Organisasi',
                'alias' => 'Biro Organisasi',
                'slug' => 'biro-organisasi'
            ],
            [
                'name' => 'Biro Administrasi Pembangunan',
                'alias' => 'Biro Adbang',
                'slug' => 'biro-adbang'
            ],
            [
                'name' => 'Biro Pemerintahan Perbatasan dan OTDA',
                'alias' => 'Biro PPOD',
                'slug' => 'biro-ppod'
            ],
            [
                'name' => 'Biro Infrastruktur dan Sumber Daya',
                'alias' => 'Biro ISD',
                'slug' => 'biro-isd'
            ]
        ];

        Biro::insert($data);
    }
}
