<?php

use Illuminate\Database\Seeder;
use App\Property;

class PropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Property::create([
            'name' => 'La rioja',
            'description' => 'Relajante y buen servicio',
            'category_property' => 1,
            'valoration' => 0.0,
            'location' => "viña del mar",
            'location_description' => "cerca del centro",
            'user_autor' => 2
        ]);

        Property::create([
            'name' => 'Cañaral',
            'description' => 'Relajante y buen servicio',
            'category_property' => 1,
            'valoration' => 0.0,
            'location' => "viña del mar",
            'location_description' => "cerca del centro",
            'user_autor' => 2
        ]);
    }
}