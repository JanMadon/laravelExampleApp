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
        // DODAWANIE DANYCH DO DB PRZAZ ELOQUENT'A:
            //1)
            // $newGame = new Game();
            // $newGame->title = 'the last of us';
            // $newGame->dexcription = 'Men and young girl fight with zombie';
            // $newGame->score = 10;
            // $newGame->publisher = 'Nauthy Dog';
            // $newGame->genre_id = 4;
            // $newGame->save();

            //  2)
            // Game::create([
            //     'title' => 'doom',
            //     'dexcription' => 'destroy monster and ghost',
            //     'score' => 9,
            //     'publisher' => 'Bethesda',
            //     'genre_id' => 1
            // ]);
                                // w 2 i 3 przypadku koniecznie jest ustawienie własciwości fillalow
                                //  protected $fillable = [
                                                        //  'title', 'dexcription', 'score', 'publisher', 'genre_id'];

            // 3)
            // $newGame = new Game([
            //     'title' => 'Mario',
            //     'dexcription' => 'you have to save princes peach',
            //     'score' => 10,
            //     'publisher' => 'nittendo',
            //     'genre_id' => 2
            // ]);
            // $newGame->save();

        // AKTUALIZACJA DANYCH PRZEZ ELOQUENT'A:
                // aktualizacja jednego wpisu:
        // $game = Game::find(123);
        // $game->dexcription = 'nowy opis';
        // $game->save();

        //$gamesID = [101,102,103,104];

        // foreach ($gamesID as $gameID) {  //  tak sie nie robi bo obciąza DB
        //     $game = Game::find($gameID);
        //     $game->dexcription = 'opis w pętli';
        //     $game->title = 'tytul w petli';
        //     $game->save();
        // }

        // Game::whereIn('id', $gamesID) // tak sie robi w przypadku wielu wpisow
        //     ->update([
        //         'dexcription' => "podmiana wielu wpisow bez petli",
        //         'title' => 'AAA'
        //     ]);

        //dd($game);

        //USUWANIE DANYCH:
            //pojedyczy wpis:
        // $game = Game::find(120);
        // $game->delete();

        // Game::destroy(122); <- nie zostanie wyrzucony blad jeśli go nie ma
        //Game::destroy(119,121); // jedno zapytanie do DB na jeden wpis
        //Game::destroy([117,118]); // mozna i tak, ale nic się nie zmniea
        //Game::wherein('id', [115, 116])->delete(); // jedno wieksze zapytanie, NAJBARDZIEJ OPTYMALNY SPOSÓB



        $games = Game:: with('genre')  //Dodaje relacje, pozwala zoptimalizować ilość zapytań do bazy danych
                    //->publisher('Bethesda', 'Nauthy Dog', 'nittendo')
                    ->orderBy('created_at')
                    ->paginate(102);
        // dd($games);

        return view('games.eloquent.list', ['games' => $games]);
    }

    public function dashboard(): View // zwraca listing gier
    {
    $games = Game::with('genre')->get();
    $oldGames = DB::table('games')->get();


     $bestGames = Game::with('genre')
                ->best()
                ->get(); // jeżeli uzyjemy np where dosatjemy obiekt buildera(podobny) stąd ->get()
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

    public function show(int $gameId, Request $request): View  //prezentowane sa dzczegoly kontretnej gry
    {

        // dd($request->ajax());
        // $game = Game::find($gameId);
        //  $game = Game::findOrFail(555); // jeśli nie znajdzie to wywali 404
        //  $game = Game::where('id', 666)->first();
         $game = Game::firstWhere('id', $gameId);
         //$game = Game::genree($gameId)->first();


        return view('games.eloquent.show', ['game' => $game]);
    }


}
