<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddGameToUserList;
use App\Http\Requests\RateGame;
use App\Http\Requests\RemoveGametoUserList;
use App\Repository\GameRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GameController extends Controller
{

    private GameRepository $gameRepository;

    public function __construct(GameRepository $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function list()
    {
        $user = Auth::user();

        return view('me.game.list', [
            'games' => $user->games()->paginate(10),
        ]);
    }

    public function add(AddGameToUserList $request)
    {
        $data = $request->validated();
        $gameId = $data['gameId'];
        //$gameId = 4288415; // jeśli nie bedzie id w bazie danych odda null
        $game = $this->gameRepository->get($gameId); // dostajemy całe info na temat tej gry

        $user = Auth::user();
        $user->addGame($game);

        return redirect()
            ->route('games.show', ['gameId' => $gameId])
            ->with('status', 'Gra została dodana');
    }

    public function remove(RemoveGametoUserList $request)
    {
        $data = $request->validated();
        $gameId = $data['gameId'];

        $game = $this->gameRepository->get($gameId);

        $user = Auth::user();
        $user->removeGame($game);

        return redirect()->route('games.show', ['gameId' => $gameId]);

    }

    public function rate(RateGame $request)
    {
        $data = $request->validated();
        
        $gameId = (int) $data['gameId'];
        $rate = $data['rate'] ? (int) $data['rate'] : null;
        
        $game = $this->gameRepository->get($gameId);



        $user = Auth::user();
        $user->rateGame($game, $rate);


        return redirect()->route('me.games.list')->with('status', 'Ocena została zapisana');



    }
}
