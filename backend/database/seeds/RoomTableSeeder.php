<?php

use Illuminate\Database\Seeder;
use App\Room;

class RoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Room::create([
            'name' => 'Suit precidencial',
            'description' => 'Limpa y espaciosa',
            'room_category' => 1,
            'property_autor' => 2
        ]);
        Room::create([
            'name' => 'habitacion comun',
            'description' => 'con televicion',
            'room_category' => 1,
            'property_autor' => 2
        ]);
    }
}