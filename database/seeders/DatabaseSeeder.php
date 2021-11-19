<?php

namespace Database\Seeders;

use App\Models\User;
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
        //Aufruf der verschiedenen Seeder zur Voreinstellung der Databases
        $this->call(HashtagSeeder::class);

        $this->call(UserSeeder::class);
    }
}
