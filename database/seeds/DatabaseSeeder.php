<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            CategorySeeder::class,
            BiroSeeder::class,
            UsersTableSeeder::class,
            ReceiverSeeder::class,
            // InboxSeeder::class,
            // OutboxSeeder::class,
            PetugasTtdSeeder::class,
            // ForwardSeeder::class,
            // AgendaSeeder::class,
            ClasificationSeeder::class,
            // ArchiveSeeder::class,
            PejabatSeeder::class,
            KopSeeder::class,
            SptTemplateSeeder::class,
            // VisitorSeeder::class,
        ]);
    }
}
