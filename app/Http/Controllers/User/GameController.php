<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddGameToUserList;
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

    public function remove()
    {
    }

    public function rate()
    {
    }
}
