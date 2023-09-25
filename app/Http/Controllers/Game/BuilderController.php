<?php

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Repository\GameRepository;

class BuilderController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository=$repository;
       dump(get_class($repository));
    }

    public function index(): View
    {
        $games = $this->gameRepository->all();

        return view('games.list', ['games' => $this->gameRepository->allPaginated(10)]);
    }

    public function dashboard(): View
    {
        $games = $this->gameRepository->all();
        $bestGames = $this->gameRepository->best();

        $stats = $this->gameRepository->stats();

        $scoreStats = $this->gameRepository->scoreStats();

        return view('games.dashboard', [
            'games' => $games = $this->gameRepository->all(),
            'bestGames' => $this->gameRepository->best(),
            'stats' => $this->gameRepository->stats(),
            'scoreStats' => $this->gameRepository->scoreStats()
        ]);
    }

    public function show(int $gameId): View 
    {
        $game = $this->gameRepository->get($gameId);
        return view('games.show', ['game' => $this->gameRepository->get($gameId)]);
    }
}
