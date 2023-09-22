<?php

namespace App\Repository;

use App\Models\Game;

class GameRepository
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
        return $this->gameModel->with('genre')->get();
    }

    public function allPaginated(int $limit)
    {
        return $this->gameModel->with('genre')->orderBy('created_at')->paginate($limit);
    }

    public function best()
    {
        return $this->gameModel->with('genre')->best()->get();
    }

    public function stats()
    {
        return [
            'count' =>  $this->gameModel->count(),
            'countScoreGTFive' => $this->gameModel->where('score', '>=', 5)->count(),
            'max' => $this->gameModel->max('score'),
            'min' => $this->gameModel->min('score'),
            'avg' => $this->gameModel->avg('score')
        ];
    }
    public function scoreStats()
    {
        return $this->gameModel->select($this->gameModel->raw('count(*) as count'), 'score')
        ->having('count', '>', 10)
        ->groupBy('score')
        ->orderBy('score', 'desc')
        ->get();
    }
}
