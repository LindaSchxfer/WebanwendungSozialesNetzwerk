<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //Aufruf der verschiedenen Seeder zur Voreinstellung der Databases falls migrate:fresh gemacht wird
        $this->call(HashtagSeeder::class);

        $this->call(UserSeeder::class);

        $this->call(AdminSeeder::class);

    }
}
