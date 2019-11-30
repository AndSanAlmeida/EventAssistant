<?php

use Illuminate\Database\Seeder;
use App\Localization;

class LocalizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	// Remove Tudo quando é corrido
        Localization::truncate();

        Localization::create([
            'event_id' => '1',
            'localization' => 'Lisboa City',
            'latitude' => '38.721711',
            'longitude' => '-9.136848'
        ]);

        Localization::create([
            'event_id' => '1',
            'localization' => 'Fátima City',
            'latitude' => '38.721711',
            'longitude' => '-9.136848'
        ]);

        Localization::create([
            'event_id' => '2',
            'localization' => 'Lisboa City',
            'latitude' => '38.721711',
            'longitude' => '-9.136848'
        ]);

        Localization::create([
            'event_id' => '2',
            'localization' => 'Fátima City',
            'latitude' => '38.721711',
            'longitude' => '-9.136848'
        ]);
    }
}
