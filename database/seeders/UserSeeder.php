<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            );
        });
    }
}
