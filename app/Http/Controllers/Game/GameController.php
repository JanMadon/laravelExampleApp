<?php
// wyciaganie danych bedzie przez repository

namespace App\Http\Controllers\Game;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
//use App\Repository\Builder\GameRepository;
//use App\Repository\Eloquent\GameRepository;
use App\Repository\GameRepository;

class GameController extends Controller
{
    private GameRepository $gameRepository;

    public function __construct(GameRepository $repository)
    {
        $this->gameRepository=$repository;
    }

    public function index(): View
    {
        $games = $this->gameRepository->all();

        return view('games.list', ['games' => $this->gameRepository->allPaginated(10)]);
    }

    public function dashboard(): View // zwraca listing gier
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

    public function show(int $gameId): View  //prezentowane sa dzczegoly kontretnej gry
    {
        $game = $this->gameRepository->get($gameId);
        return view('games.show', ['game' => $this->gameRepository->get($gameId)]);
    }
}
