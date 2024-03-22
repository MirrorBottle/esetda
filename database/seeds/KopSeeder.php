<?php

use Illuminate\Database\Seeder;

class KopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $img_path = url('images');
        $data = [
            [
                'type' => 1,
                'title' => 'Kop Lembar Disposisi Gubernur / Wakil Gubernur',
                'content' => '<img src="'. $img_path.'/garuda.png" style="width: 60px;">'
            ],
            [
                'type' => 2,
                'title' => 'Kop Lembar Disposisi Setda',
                'content' => '<table style="width: 100%; font-size: 10px;"><tr><td style="width: 65px;"><img src="'. $img_path.'/kaltim-logo.jpg" style="width: 40px;margin-top: 4px;margin-left: 0px;"></td><td><div style="text-align: center; margin-left: -4.3rem;"><h4>PEMERINTAH PROVINSI KALIMANTAN TIMUR</h4><h2>SEKRETARIAT DAERAH</h2><p>JALAN GAJAH MADA, TELEPON (0541) 733333 Fax.(0541) 737762-742111</p><p>Home Page: http://kaltimprov.go.id</p><p>SAMARINDA 75121</p></div></td></tr></table>'
            ],
            [
                'type' => 3,
                'title' => 'Kop Laporan Surat',
                'content' => '<table style="width: 100%;"><tr><td style="width: 85px;"><img src="'. $img_path.'/kaltim-logo.jpg" style="width: 68px; margin-top: 20px; margin-left: 24px;"></td><td><div style="text-align: center; margin-left: -5.5rem;"><h4>PEMERINTAH PROVINSI KALIMANTAN TIMUR</h4><h1>SEKRETARIAT DAERAH</h1><p>JALAN GAJAH MADA, TELEPON (0541) 733333 Fax.(0541) 737762-742111</p><p>Home Page: http://kaltimprov.go.id</p><p>SAMARINDA 75121</p></div></td></tr></table>'
            ]
        ];

        \App\Kop::insert($data);
    }
}
