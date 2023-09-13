<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('games')->truncate();
        $faker = Factory::create('games');

       // to trwa ok. 0,3s bo jedno wielkie zapytanie
        $games = [];
        for($i=0; $i<100; $i++) {
            $game =
            [
                'title'=> $faker->words($faker->numberBetween(1,3), true),
                'dexcription'=> $faker->sentence,
                'publisher'=> $faker->randomElement(['Atari', 'EA', 'Ubisoft', 'RockStar', 'CD_Project', 'Sony']),
                'genre_id'=> $faker->numberBetween(1,5),
                 'score' => $faker->numberBetween(1,100),
                'created_at'=> Carbon::now(),
                'updated_at'=>Carbon::now()
            ];
            array_push($games, $game);
        };

        DB::table('games')->insert($games);


        // to trwa ok 11s
        // for($i=0; $i<5000; $i++) {
        //     DB::table('games')->insert([

        //         'title'=> $faker->words($faker->numberBetween(1,3), true),
        //         'dexcription'=> $faker->sentence,
        //         'publisher'=> $faker->randomElement(['Atari', 'EA', 'Ubisoft', 'RockStar', 'CD_Project', 'Sony']),
        //         'genre_id'=> $faker->numberBetween(1,5),
        //         'created_at'=> Carbon::now(),
        //         'updated_at'=>Carbon::now()
        //     ]
        //     );
        // };

    }
}
