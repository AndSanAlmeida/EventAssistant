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
        $this->call(RolesTableSeeder::class);
        //User dão seed depois das Roles por causa do Attach
        $this->call(UsersTableSeeder::class);
    }
}
