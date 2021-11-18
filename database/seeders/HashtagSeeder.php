<?php

namespace Database\Seeders;

use App\Models\Hashtag;

use Illuminate\Database\Seeder;

class HashtagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hashtags = [
            '#sport' => 'primary', // blau
            '#entspannung' => 'secondary', // grau-grau
            '#fun' => 'warning', // gelb
            '#natur' => 'success', // grün
            '#inspiration' => 'light', // weiß-grau
            '#freunde' => 'info', // türkis
            '#liebe' => 'danger', // rot
            '#tiere' => 'dark' // schwarz-weiss
        ];

        foreach ($hashtags as $key => $value) {
            $hashtag = new Hashtag(
                [
                    'name' => $key,
                    'color' => $value
                ]
            );
            $hashtag->save();
        }

    }
    
}
