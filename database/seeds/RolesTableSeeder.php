<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id'         => 1,
                'title'      => 'Admin',
                'created_at' => '2020-01-01 12:00:00',
                'updated_at' => '2020-01-01 12:00:00',
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'title'      => 'Karo',
                'created_at' => '2020-01-01 12:00:00',
                'updated_at' => '2020-01-01 12:00:00',
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'title'      => 'User',
                'created_at' => '2020-01-01 12:00:00',
                'updated_at' => '2020-01-01 12:00:00',
                'deleted_at' => null,
            ]
        ];

        Role::insert($roles);
    }
}
