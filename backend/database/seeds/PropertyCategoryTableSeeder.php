<?php

use Illuminate\Database\Seeder;
use App\PropertyCategory;

class PropertyCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyCategory::create([
            'name' => 'test'
        ]);
        PropertyCategory::create([
            'name' => 'test2'
        ]);
    }
}