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
        $this->call(RolesAndPermissions::class);
        $this->call(UserTableSeeder::class);
        $this->call(PropertyCategoryTableSeeder::class);
        $this->call(PropertyTableSeeder::class);
        $this->call(RoomCategoryTableSeeder::class);
        $this->call(RoomTableSeeder::class);
    }
}
