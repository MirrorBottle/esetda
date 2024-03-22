<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClasificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // import sql file
        DB::unprepared(file_get_contents(public_path('clasifications.sql')));
    }
}
