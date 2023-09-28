<?php
// declare(strict_types=1)1;
namespace App\Repository\Eloquent;

use App\Models\Game;
use App\Repository\GameRepository as EloquentGameRepository;
use App\Service\FakeService;
use stdClass;

class GameRepository implements EloquentGameRepository
{
    private Game $gameModel;

    public function __construct(Game $gameModel)
    {
        $this->gameModel = $gameModel;
    }

    public function get(int $id)
    {
        return $this->gameModel->find($id);
    }

    public function all()
    {
        // dd($this->gameModel->with('genre')->get());
        return $this->gameModel->with('genres')->orderBy('created_at')->get();
    }

    public function allPaginated(int $limit)
    {

        return $this->gameModel->with('genres')->orderBy('created_at')->paginate($limit);
    }

    public function filderBy (?string $phrase, ?string $type = 'all', int $limit)
    {
        $query = $this->gameModel
            ->with('genres')
            ->orderBy('created_at');

            $type = null ?? 'all';

            if($type!='all') {
                $query->where('type', $type);
            }

            if ($phrase) {
                $query->whereRaw('description like ?', ["%$phrase%"]);
            }

            return $query->paginate($limit);
    }



    public function best()
    {
        return $this->gameModel->with('genres')->best()->get();
    }

    public function stats()
    {
        return [
            'count' =>  $this->gameModel->count(),
            'countScoreGTFive' => $this->gameModel->where('metacritic_score', '>=', 70)->count(),
            'max' => $this->gameModel->max('metacritic_score'),
            'min' => $this->gameModel->min('metacritic_score'),
            'avg' => round($this->gameModel->avg('metacritic_score'), 2),
        ];
    }
    public function scoreStats()
    {
        return $this->gameModel->select($this->gameModel->raw('count(*) as count'), 'metacritic_score')
            ->having('metacritic_score', '>', 10)
            ->groupBy('metacritic_score')
            ->orderBy('metacritic_score', 'desc')
            ->get();
    }
}
