<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class EloquentController extends Controller
{

    public function index(): View
    {
        $games = Game::orderBy('created_at')
                    ->paginate(102);

        return view('games.eloquent.list', ['games' => $games]);
    }

    public function dashboard(): View // zwraca listing gier
    {
    $games = Game::all();
    $oldGames = DB::table('games')->get();


     $bestGames = Game::where('score', '>', 5)->get(); // jeżeli uzyjemy np where dosatjemy obiekt buildera(podobny) stąd ->get()
    //  $bestGames = DB::table('games')->where('score', '>', 5)->get();
    // dd($bestGames);

    $stats = [
        'count' => Game::count(),
        'countScoreGTFive' => Game::where('score', '>=', 5)->count(),
        'max' => Game::max('score'),
        'min' => Game::min('score'),
        'avg' => Game::avg('score')
    ];

    $scoreStats = Game::
             select(Game::raw('count(*) as count'),'score')
            -> having('count','>', 10)
            -> groupBy('score')
            -> orderBy('score','desc')
            -> get();

       return view('games.eloquent.dashboard', [
            'games' => $games,
            'bestGames' => $bestGames,
            'stats' => $stats,
            'scoreStats' => $scoreStats
       ]);
    }

    public function show(int $gameId):  View  //prezentowane sa dzczegoly kontretnej gry
    {
        // $game = Game::find($gameId);
        //  $game = Game::findOrFail(555); // jeśli nie znajdzie to wywali 404

        //  $game = Game::where('id', 666)->first();
         $game = Game::firstWhere('id', $gameId);


        return view('games.eloquent.show', ['game' => $game]);
    }


}
