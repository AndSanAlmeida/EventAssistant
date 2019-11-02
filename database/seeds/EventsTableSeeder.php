<?php

use Illuminate\Database\Seeder;
use App\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Remove Tudo quando é corrido
        Event::truncate();

        // Event::create([
        // 	'user_id' => '1',
        // 	'name' => 'Rui e Maria',
        // 	'date' => '2020/09/19',
        // 	'hour' => '11:00',
        // 	'slug' => 'rui_e_maria',
        // 	'active' => 1,
        // ]);
    }
}
