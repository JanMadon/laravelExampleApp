<?php
// declare(strict_types=1);
namespace App\Repository\Builder;

use App\Models\Game;
use Illuminate\Support\Facades\DB;
use App\Repository\GameRepository as BuilderGameRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use stdClass;

class GameRepository implements BuilderGameRepository
{
    private DB $gameTabele;

    public function __construct(DB $gameTabele)
    {
        $this->gameTabele = $gameTabele;
    }

    public function get(int $id)
    {
        $game = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id', 'games.publisher', 'games.dexcription',
                    'genres.name as genres_name',
                ])
                ->where('games.id', $id)->first();
        //dd($game);
        return $this->createGame($game);
    }

    public function all()
    {
        $games = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                        ])
                ->get()
                ->map(fn($row) => $this->createGame($row));

        return $games;
    }

    public function allPaginated(int $limit)
    {
        $pageName = 'page';
        $currentPage = Paginator::resolveCurrentPage($pageName);
        //dd($currentPage);

        $baseQuery = DB::table('games')
                    ->join('genres', 'games.genre_id', '=', 'genres.id');

        $total = $baseQuery->count();

        if($total){
            $games = DB::table('games')
                    ->join('genres', 'games.genre_id', '=', 'genres.id')
                    ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                    'genres.name as genres_name',
                ])
                ->orderBy('games.created_at', 'desc')
                ->forPage($currentPage, $limit)
                ->get()
                ->map(fn($row) => $this->createGame($row));
        }
        return new LengthAwarePaginator(
            $games,
            $total,
            $limit,
            $currentPage,
            [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName
            ]);
    }

    public function best()
    {
        $bestGames = DB::table('games')
                ->join('genres', 'games.genre_id', '=', 'genres.id')
                ->select(['games.id','games.title', 'games.score', 'games.genre_id',
                            'genres.name as genres_name',
                         ])
                ->where('score', '>=', 9)
                ->get()
        ->map(fn($row) => $this->createGame($row));
        return $bestGames;
    }

    public function stats()
    {
        $stats = [
            'count' => DB::table('games')->count(),
            'countScoreGTFive' => DB::table('games')->where('score', '>=', 5)->count(),
            'max' => DB::table('games')->max('score'),
            'min' => DB::table('games')->min('score'),
            'avg' => DB::table('games')->avg('score')
        ];
        return $stats;

    }
    public function scoreStats()
    {
        $scoreStats = DB::table('games')
            -> select(DB::raw('count(*) as count'),'score')
            -> having('count','>', 10)
            -> groupBy('score')
            -> orderBy('score','desc')
            -> get();

        return $scoreStats;
    }

    private function createGame(stdClass $game): stdClass
    {
        $genre = new stdClass();
        $genre->id = $game->genre_id;
        $genre->name = $game->genres_name;
        $game->genre = $genre;
        unset($game->genre_id);
        unset($game->genres_name);
    return $game;
    }
    public function filderBy(?string $phrase, string $type, int $limit) {
        
    }

}
