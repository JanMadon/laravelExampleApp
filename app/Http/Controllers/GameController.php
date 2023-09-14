<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


//php artisan make:controller GameController --resource
// tzw. controller CRUD create, read, update, delete
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View // zwraca listing gier
    {

    // $games = DB::table('games')
    //  ->select(['id','title', 'score', 'genre_id']) //pobieramy tylko te kolumny
    // ->get();

    $games = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                        ])
            ->get();

    $bestGames = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                         ])
                ->where('score', '>', 95);
                // ->where('score', 95) // defolt '='
                // ->get();

    // dd($bestGames->toSql()); // ale musisz wykonać na obiekcie Builder (czyli bez ->get());

    $query = DB::table('game')
                -> select('id', 'title', 'score', 'genre_id')
                ->where(
                            ['id', '>', 65],
                            ['score','<',45 ] // to jest jak AND
                        );


    $query = DB::table('game')
                -> select('id', 'title', 'score', 'genre_id')
                ->where('id', '>', 65)
                ->orWhere('score', '>', 65);  // to jest jak OR

    $query = DB::table('game')
                -> select('id', 'title', 'score', 'genre_id') //Posziędzy
                ->whereBetween('id',[12, 18]);

    // $query = DB::table('game')
    //             -> select('id', 'title', 'score', 'genre_id') 
    //             ->whereBetweenColumns('id',[12, 18]);



    dd($query->toSql());


    $stats = [
        'count' => Db::table('games')->count(),
        'countScoreGTFive' => Db::table('games')->where('score', '>=', 5)->count(),
        'max' => DB::table('games')->max('score'),
        'min' => DB::table('games')->min('score'),
        'avg' => DB::table('games')->avg('score')
    ];
    dump($stats);

       return view('games.list', [
            'games' => $games,
            'bestGames' => $bestGames,
            'stats' => $stats
       ]);
    }

    public function show(int $gameId):  View  //prezentowane sa dzczegoly kontretnej gry
    {
        //$game = DB::table('games')->where('id', $gameId)->get(); // case 1 (tablica tablic zew 1 el, wew 8el )
         $game = DB::table('games')->where('id', $gameId)->first(); // case2 (tablica z 8 el)
        //$game = DB::table('games')->find($gameId); // case 3 - jakby alias do case 2

        // dd($game->toArray()); // zutowanie na tablice ale tylko dla sposobu pierwszego.
        // dd((array) $game);
        return view('games.show', ['game' => (array) $game]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('game.create');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {


    // }

    // /**
    //  * Display the specified resource.
    //  */


    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(string $id)
    // {
    //     return view('game.edit');
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     return view('game.update');
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     return view('game.destroy');

    // }

    // public function test(string $name){
    //     return 'tupa';
    // }


}
