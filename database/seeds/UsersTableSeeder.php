<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Biro;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array();

        // users admin global (1 - 3)
        $data[] = [
            'type' => 0,
            'biro_id' => null,
            'receiver_id' => null,
            'username' => 'admin',
            'name' => 'Administator',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin'),
            'disposition_password' => null,
            'wa' => '6282255682584'
        ];

        $data[] = [
            'type' => 1,
            'biro_id' => 1,
            'receiver_id' => null,
            'username' => 'tu_pimpinan2',
            'name' => 'Tu Pimpinan 2',
            'email' => 'tu_pimpinan2@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'disposition_password' => null,
            'wa' => '6282255682584'
        ];

        $data[] = [
            'type' => 0,
            'biro_id' => null,
            'receiver_id' => null,
            'username' => 'fahmi',
            'name' => 'Fahmi Fitnanda',
            'email' => 'fahmi@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'disposition_password' => null,
            'wa' => '6282255682584'
        ];


        // user biro (4 - 33)
        $biros = Biro::all();
        $karo_receivers = [null, 15, 10, 11, 8, 16, 14, 13, 9, 12];
        $receiver_index = 0;
        foreach ($biros as $biro) {
            $biro_slug = str_replace("-", "_", $biro->slug);
            $karo_slug = str_replace("biro-", "", $biro->slug);
            if ($biro->slug == 'tu-pimpinan') {
                $karo_slug = 'tu_pimpinan';
            }
            // users karo
            $data[] = [
                'type' => 1,
                'biro_id' => $biro->id,
                'receiver_id' => $karo_receivers[$receiver_index++],
                'username' => 'karo_'. $karo_slug,
                'name' => 'Kepala '. $biro->alias,
                'email' => 'karo_'. $karo_slug . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'disposition_password' => Hash::make('123456'),
                'wa' => '6282255682584'
            ];

            // users operator biro
            $data[] = [
                'type' => 1,
                'biro_id' => $biro->id,
                'receiver_id' => null,
                'username' => $biro_slug,
                'name' => 'Operator '. $biro->alias,
                'email' => 'operator_'. $biro_slug . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'disposition_password' => null,
                'wa' => '6282255682584'
            ];

             // user operator arsip
            $data[] = [
                'type' => 3,
                'biro_id' => $biro->id,
                'receiver_id' => null,
                'username' => 'arsip_'. $biro_slug,
                'name' => 'Operator Arsip '. $biro->alias,
                'email' => 'operator_arsip_'.$biro_slug.'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'disposition_password' => null,
                'wa' => '6282255682584'
            ];
        }

        // admin arsip (biro umum - 34)
        $data[] = [
            'type' => 3,
            'biro_id' => null,
            'receiver_id' => null,
            'username' => 'arsip',
            'name' => 'Admin Arsip',
            'email' => 'arsip@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'disposition_password' => null,
            'wa' => '6282255682584'
        ];

        // admin agenda (35)
        $data[] = [
            'type' => 2,
            'biro_id' => null,
            'receiver_id' => null,
            'username' => 'agenda',
            'name' => 'Admin Agenda',
            'email' => 'agenda@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123123'),
            'disposition_password' => null,
            'wa' => '6282255682584'
        ];

        // agenda tujuan (36 - 41)
        $agenda_tujuan = [
            ['code' => 'gub', 'position' => 'Gubernur'],
            ['code' => 'wagub', 'position' => 'Wakil Gubernur'],
            ['code' => 'sekda', 'position' => 'Sekretaris Daerah'],
            ['code' => 'asis1', 'position' => 'Assisten I'],
            ['code' => 'asis2', 'position' => 'Assisten II'],
            ['code' => 'asis3', 'position' => 'Assisten III'],
        ];

        foreach ($agenda_tujuan as $agenda) {
            $data[] = [
                'type' => 2,
                'biro_id' => null,
                'receiver_id' => null,
                'username' => 'agenda_'. $agenda['code'],
                'name' => 'Agenda '. $agenda['position'],
                'email' => 'agenda_'.$agenda['code'].'@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'disposition_password' => null,
                'wa' => '6282255682584'
            ];
        }

        // user admin tujuan
        $list_admin_tujuan = [
            ['username' => 'admin_gub', 'name' => 'ADMIN GUBERNUR'],
            ['username' => 'admin_wagub', 'name' => 'ADMIN WAKIL GUBERNUR'],
            ['username' => 'admin_sekda', 'name' => 'ADMIN SEKRETARIS DAERAH'],
            ['username' => 'admin_staffahli', 'name' => 'ADMIN STAFF AHLI GUBERNUR'],
            ['username' => 'admin_asis1', 'name' => 'ADMIN ASSISTEN I'],
            ['username' => 'admin_asis2', 'name' => 'ADMIN ASSISTEN II'],
            ['username' => 'admin_asis3', 'name' => 'ADMIN ASSISTEN III'],
        ];

        foreach ($list_admin_tujuan as $index => $admin_tujuan) {
            $data[] = [
                'type' => 0,
                'biro_id' => null,
                'receiver_id' => ($index+1),
                'username' => $admin_tujuan['username'],
                'name' => $admin_tujuan['name'],
                'email' => $admin_tujuan['username'] . '@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123123'),
                'disposition_password' => Hash::make('123456'),
                'wa' => '6282255682584'
            ];
        }

        // insert all users data
        User::insert($data);

        // assign user roles
        foreach (User::all() as $user) {
            if ($user->id <= 2 || $user->id == 34 || $user->id == 35 || $user->id == 42 || $user->id == 43 || $user->id == 44 || $user->id == 45 || $user->id == 46 || $user->id == 47 || $user->id == 48) {
                $user->roles()->sync(1);
            } else {
                if (strpos($user->name, 'Karo') !== false) {
                    $user->roles()->sync(2);
                } else {
                    $user->roles()->sync(3);
                }
            }
        }
    }
}
