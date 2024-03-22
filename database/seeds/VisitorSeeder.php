<?php

use Illuminate\Database\Seeder;
use App\Visitor;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();
        $receiver_id = range(1, 7);
        foreach (range(1, 20) as $index) {
            $data[] = [
                'sender' => 'Visitor '. $index,
                'institution' => 'INSTITUSI '. $index,
                'whatsapp' => '081242875660',
                'email' => 'visitor_'. $index. '@gmail.com',
                'letter_no' => 'VST/000'. $index . '/X/'. date('Y'),
                'letter_title' => 'Surat masuk tamu #'. $index,
                'receiver_id' => $receiver_id[rand(0, 6)],
                'description' => 'something.....',
                'status' => 0,
                'unique_key' => unique_key(),
            ];
        }

        Visitor::insert($data);
    }
}
