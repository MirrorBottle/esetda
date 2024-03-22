<?php

use Illuminate\Database\Seeder;

class LetterNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // master
        $master_data = [
            [
                'month_year' => '2020-10-01',
                'start' => 1,
                'end' => 100
            ],
            [
                'month_year' => '2020-11-01',
                'start' => 200,
                'end' => 300
            ],
            [
                'month_year' => '2020-12-01',
                'start' => 301,
                'end' => 400
            ],
        ];

        // used
        $used_data = [
            [
                'letter_number_id' => 1,
                'number' => '0099/KGB/X/2020',
                'sender' => 'Dinas Kesehatan Kota Samarinda',
                'order' => 99
            ],
            [
                'letter_number_id' => 1,
                'number' => '0100/KGB/X/2020',
                'sender' => 'Dinas Pendidikan Kota Samarinda',
                'order' => 100
            ],
            [
                'letter_number_id' => 2,
                'number' => '0201/KGB/XI/2020',
                'sender' => 'Dinas Kominfo Kota Samarinda',
                'order' => 201
            ],
            [
                'letter_number_id' => 2,
                'number' => '0202/KGB/XI/2020',
                'sender' => 'Dinas Kehutanan Kota Samarinda',
                'order' => 202
            ],
            [
                'letter_number_id' => 3,
                'number' => '0301/KGB/XII/2020',
                'sender' => 'Dinas Pariwisata Kota Samarinda',
                'order' => 301
            ],
            [
                'letter_number_id' => 3,
                'number' => '0302/KGB/XII/2020',
                'sender' => 'Dinas Kelautan Kota Samarinda',
                'order' => 302
            ]
        ];

        \App\LetterNumber::insert($master_data);
        \App\LetterNumberUsed::insert($used_data);
    }
}
