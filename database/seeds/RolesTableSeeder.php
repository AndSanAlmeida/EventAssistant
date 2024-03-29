<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Remove Tudo quando é corrido
        Role::truncate();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
