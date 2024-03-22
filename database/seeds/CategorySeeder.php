<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'Surat Dinas'],
            ['name' => 'Tembusan'],
            ['name' => 'Lain-lain'],
        ];

        Category::insert($data);
    }
}
