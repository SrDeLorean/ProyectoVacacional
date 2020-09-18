<?php

use Illuminate\Database\Seeder;
use App\RoomCategory;

class RoomCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoomCategory::create([
            'name' => 'hotel'
        ]);
        RoomCategory::create([
            'name' => 'cabaña'
        ]);
    }
}