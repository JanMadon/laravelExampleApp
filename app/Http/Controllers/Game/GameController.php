<?php

namespace App\Http\Controllers\Game;

use App\Facade\Game;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Repository\GameRepository;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository = $repository;
    }

    public function index(Request $request): View
    {

        $phrase = $request->get('phrase');
        $type = $request->get('type');
        //dump($phrase ,$type);

        $filterBy = $this->gameRepository->filderBy($phrase, $type, 15);
        // $filterBy->appends( [ //to jest po to aby nie gubił query paramiters podczas zmiany strony
        //     'phrase' => $phrase,
        //     'type' =>$type
        // ]);
        //dump($filterBy);

        //dd($this->gameRepository->allPaginated(10));
        return view('games.list', [
            //'games' => $this->gameRepository->allPaginated(50)
            'games' => $filterBy,
            'phrase' => $phrase,
            'type' =>$type
        ]);
    }

    public function dashboard(): View
    {
        return view('games.dashboard', [
            'bestGames' => $this->gameRepository->best(),
            'stats' => $this->gameRepository->stats(),
            'scoreStats' => $this->gameRepository->scoreStats()
        ]);
    }

    public function show(int $gameId, Request $request): View
    {

        $user = Auth::user();
        $userHasGame = $user->hasGame($gameId);
        //dd($userHasGame);


        return view('games.show', [
            'game' => $this->gameRepository->get($gameId),
            'userHasGame' => $userHasGame
        ]);
    }

 }
