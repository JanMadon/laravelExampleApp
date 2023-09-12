<?php

// php artisan make:seeder GenresSeeder

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;


class GenresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // dodajemy pule gatunkow gier
         DB::table('genres')->truncate(); // czyści tabele po uruchomieniu

        DB::table('genres')->insert([
            ['id'=>1, 'name'=> 'RPG2', 'created_at'=>Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>2, 'name'=> 'Adventage', 'created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>3, 'name'=> 'FPS', 'created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>4, 'name'=> 'Sport', 'created_at'=> Carbon::now(),'updated_at'=>Carbon::now()],
            ['id'=>5, 'name'=> 'Sim', 'created_at'=> Carbon::now(),'updated_at'=>Carbon::now() ]
        ]);
    }
}
