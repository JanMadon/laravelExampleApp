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

    public function index(): View {

        $games = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                        ])
                // ->orderBy('games.score')
                //->simplePaginate(10);// lub paginate() dzieli liste na strony w wydoku wyświetlamy za pomocą {{$games->links()}} i tyle
                ->paginate(20);

                // dd($games);

        return view('games.list', ['games' => $games]);
    }
    /**
     * Display a listing of the resource.
     */


    public function dashboard(): View // zwraca listing gier
    {

    // $games = DB::table('games')
    //  ->select(['id','title', 'score', 'genre_id']) //pobieramy tylko te kolumny
    // ->get();

    $games = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                        ])
                // ->orderBy('score', 'desc') // sortowanie po score malejąco defoltowo jest asc - rosnąco
                // ->orderByDesc('score')        // zadziała tak samo
                ->limit(4) // limituje do 2 gier
                ->offset(2) // odsuniecie o 2
                ->get();

                // dd($games->toSql());


    $bestGames = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                         ])
                ->where('score', '>=', 9)
                // ->where('score', 95) // defolt '='
                ->get();

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
                ->select('id', 'title', 'score', 'genre_id') //Posziędzy
                ->whereBetween('id',[12, 18]);

    // $query = DB::table('game')
    //             -> select('id', 'title', 'score', 'genre_id')
    //             ->whereBetweenColumns('id',[12, 18]);



    // dd($query->toSql()); // przydaje się do wyswietlenia zapytania (bez ->get())


    $stats = [
        'count' => Db::table('games')->count(),
        'countScoreGTFive' => Db::table('games')->where('score', '>=', 5)->count(),
        'max' => DB::table('games')->max('score'),
        'min' => DB::table('games')->min('score'),
        'avg' => DB::table('games')->avg('score')
    ];

    $scoreStats = DB::table('games')
            -> select(DB::raw('count(*) as count'),'score') // ile gier ma dany score
            -> having('count','>', 10) // having działa podobnie do where tylko wyciąga wyniki po zgrupowaniu(where przed)
            // w przypadku kolumny count nie można użyć where bo nie ma tej kolumny na początku (wher narpiew odcina i pózniej dzieje się reszta)
            -> groupBy('score') // grupowanie
            -> orderBy('score','desc')
            -> get();

    // dump($scoreStats);

       return view('games.dashboard', [
            'games' => $games,
            'bestGames' => $bestGames,
            'stats' => $stats,
            'scoreStats' => $scoreStats
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
