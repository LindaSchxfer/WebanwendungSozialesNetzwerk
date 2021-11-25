<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User(            
            [
                'name' => 'Linda Schäfer',
                'email' => 'lindaschaefer98@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('lindagram2021'),
                'remember_token' => Str::random(10),
                'rolle' => 'admin',
            ]
        );

        $admin->save();
    }
}
