<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Remove Tudo quando é corrido
        Category::truncate();

        Category::create([
            'event_id' => '1',
            'name' => 'Baptism'
        ]);

        Category::create([
            'event_id' => '2',
            'name' => 'Marriage'
        ]);
    }
}
