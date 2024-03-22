<?php

use Illuminate\Database\Seeder;
use App\Outbox;
use App\Category;
use App\Receiver;

class OutboxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operator = [5, 8, 11, 14, 17, 20, 23, 26, 29, 32];
        $biro = [1, 2 ,3, 4, 5, 6, 7, 8, 9, 10];
        $data = array();
        foreach (range(1, 100) as $index) {
            $random_id = rand(0, 9);
            $data[] = [
                'biro_id' => $biro[$random_id],
                'user_id' => $operator[$random_id],
                'no' => 'SK_00000'. $index,
                'title' => 'Surat Keluar Sample #'. $index,
                'date' => date('Y-m-d'),
                'date_entry' => date('Y-m-d'),
                'category_id' => $this->randomCategory(),
                'receiver_id' => $this->randomReceiver(),
                'is_attachment' => 0,
            ];
        }

        Outbox::insert($data);
    }

    private function randomReceiver()
    {
        $receiver_id = Receiver::pluck('id');

        return rand(1, count($receiver_id));
    }

    private function randomCategory()
    {
        $category_id = Category::pluck('id');

        return rand(1, count($category_id));
    }
}
