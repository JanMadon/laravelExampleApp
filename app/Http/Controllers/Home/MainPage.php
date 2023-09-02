<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MainPage extends Controller {
    public function __invoke()
    {

        // DB::connection()->getPdo(); // natywny obiekt php PDO

        DB::table('genres')->truncate(); // czyści db
        DB::table('genres')->delete(); // czyści db, ale nie resetuje klucz głównego

        // dodanie rekordu
        DB::table('genres')->insert([
            'name' => 'RPG',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // dodanie wiecej nież jednego rekordu (tablica tablic):
        DB::table('genres')->insert(
            [
                [
                     'name' => 'Adventage', // name jest unicle wiec wywali bląd jesli sie powtórzy
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'FPS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]
        );

        // zabezpiecznie jesli się powtóży klucz:
        DB::table('genres')->insertOrIgnore(
            [
                [
                    'name' => 'Adventage', // jaśli name się powtuzu do wpis zosatnie zignorowany.
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'FPS',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'name' => 'Sport',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );

        // w przypadku zdekrarowania ID nastepne donane bedzie ID=13 (nie wypalnia luk)
        DB::table('genres')->insert(
            [
                'id' => 12,
                'name' => 'TPP',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );

        // doda wpis i od razu pobieże jego ID
        $id = DB::table('genres')->insertGetId(
            [
                'name' => 'Sim',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        dump($id);

        // podmiana wpisów:
        DB::table('genres')
            ->where('id',13)
            ->update(['name'=> 'Strategy']);

        // usówanie:
        DB::table('genres')
            ->where('id',3)
            ->delete();


        $connfig = config('app.name');

        return view('home.main');
    }
}


//
