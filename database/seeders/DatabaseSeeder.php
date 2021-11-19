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
        //Aufruf der verschiedenen Seeder zur Voreinstellung der Databases
        $this->call(HashtagSeeder::class);

        $this->call(UserSeeder::class);

        /*User::factory()
            ->times(100)
            ->afterCreating(function ($user) {
                Post::factory()->times(rand(1, 8))
                    ->afterCreating(function ($post) {
                        $hashtag_id = range(1, 8);
                        shuffle($hashtag_id);
                        $ver = array_slice($hashtag_id, 0, rand(0, 7));
                        foreach ($ver as $val) {
                            DB::table('hashtag_post')
                                ->insert([
                                    'post_id' => $post->id,
                                    'hashtag_id' => $val,
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);
                        }
                    })
                    ->create(['user_id' => $user->id]);
            })
            ->create();*/
    }
}
