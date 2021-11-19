<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->count(100)->create()
        
        //Erstellen von zufällig vielen Posts für Nutzer
        ->each(function($user){
            \App\Models\Post::factory(rand(2,8))->create(
                [
                    'user_id' => $user->id
                ]
            )
            ->each(function ($post) {
                $hashtag_ids  = range(1,8);
                shuffle($hashtag_ids);
                $verknuepfungen = array_slice($hashtag_ids, 0, rand(0,8)); 
                foreach ($verknuepfungen as $value) {
                    DB::table('hashtag_post')
                        ->insert(
                            [
                                'post_id' => $post->id,
                                'hashtag_id' => $value,
                                'created_at' => Now(),
                                'updated_at' => Now()
                            ]
                        );
                }
            });
        });
    }
}
