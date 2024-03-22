<?php

use App\Phone;
use App\SptTemplate;
use Illuminate\Database\Seeder;

class SptTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template_data = [
            [
                'name' => 'Template 1',
                'content' => '*INFORMASI PENGAMBILAN SPT KEPALA DINAS*\n=========================\nKepala Dinas/Badan : <kepala_dinas>\nNama Dinas/Badan : <institusi>\nTanggal Berangkat (Tujuan) : \n1. manual\n2. manual\n3. manual\n\nBerkas sudah bisa diambil di Kantor Gubernur Lt. 4 Biro Umum Bagian Keuangan.\n==========================\nInfo lebih lanjut : \na. Husein : 0853-9325-7391\nb. Fahmi : 0822-5568-2584'
            ]
        ];

        SptTemplate::insert($template_data);

        $phones_data = [
            [
                'name' => 'Burhan',
                'institution' => 'ESDM',
                'institution_head' => 'Ir. H. Frediansyah',
                'wa' => '6282342348532',
            ],
            [
                'name' => 'Dewi',
                'institution' => 'Dinas Lingkungan Hidup',
                'institution_head' => 'E.A. Rafiddin Rizal, ST, M.Si',
                'wa' => '6282299437088',
            ],
            [
                'name' => 'Dispora',
                'institution' => 'Dispora',
                'institution_head' => 'H.M. Syirajuddin,SH,MT',
                'wa' => '628125053711',
            ],
            [
                'name' => 'Elham',
                'institution' => 'Dinas PU, Penata Ruang &amp; Perumahan Rakyat',
                'institution_head' => 'Ir. H.M. Taufik Fauzie',
                'wa' => '6282149222294',
            ],
            [
                'name' => 'Endrik',
                'institution' => 'DPMPTSP',
                'institution_head' => 'H. Abu Helmi, SE, M.Si',
                'wa' => '6285247809686',
            ],
            [
                'name' => 'Fahmi',
                'institution' => 'tnanda',
                'institution_head' => 'Tes',
                'institution_head' => 'Tes',
                'wa' => '6282255682584',
            ],
            [
                'name' => 'Febri',
                'institution' => 'Inspektorat',
                'institution_head' => 'M. Kurniawan, SE, Ak, MM',
                'wa' => '6281217776755',
            ],
            [
                'name' => 'Ica',
                'institution' => 'Badan Perencanaan Pembangunan Daerah',
                'institution_head' => 'Dr. Ir. H. M. Aswin, M.M',
                'wa' => '6281351755664',
            ],
            [
                'name' => 'Ikhsan',
                'institution' => 'Bapenda',
                'institution_head' => 'Dra. Hj. Ismiati, M.Si',
                'wa' => '6285390956644',
            ],
            [
                'name' => 'Irma',
                'institution' => 'Badan Penelitian dan Pengembangan Daerah',
                'institution_head' => 'Drs. H. Elto, M.Si',
                'wa' => '6281395551716',
            ],
            [
                'name' => 'Jaya',
                'institution' => 'Dinas Lingkungan Hidup',
                'institution_head' => 'E.A. Rafiddin Rizal, ST, M.Si',
                'wa' => '6282150403002',
            ],
            [
                'name' => 'Juanda',
                'institution' => 'Kesbangpol',
                'institution_head' => 'Yudha Pranoto',
                'wa' => '6285347864590',
            ],
            [
                'name' => 'Kiki',
                'institution' => 'Dinas Perkebunan',
                'institution_head' => 'Ir. Ujang Rachmad, M.Si',
                'wa' => '6285246944998',
            ],
            [
                'name' => 'Kukuh',
                'institution' => 'Dinas Pangan, Tanaman Pangan Dan Hortikultura',
                'institution_head' => 'Ir. Dadang Sudarya, M.M.T',
                'wa' => '6281289861336',
            ],
            [
                'name' => 'Raisil',
                'institution' => 'Dinas Kependudukan, Pemberdayaan Perempuan &amp; Perlindungan Anak',
                'institution_head' => 'Ir. Hj. Halda Arsyad, MM',
                'wa' => '6285247139369',
            ],
            [
                'name' => 'Rasyid',
                'institution' => 'Dinas Peternakan',
                'institution_head' => 'Ir. Dadang Sudarya, M.M.T',
                'wa' => '6285250938260',
            ],
            [
                'name' => 'Sayid',
                'institution' => 'chmi',
                'institution_head' => 'Dinas Tenaga Kerga &amp; Transmigrasi',
                'institution_head' => 'H. Suroto, SH',
                'wa' => '6285346910123',
            ],
        ];

        Phone::insert($phones_data);
    }
}
