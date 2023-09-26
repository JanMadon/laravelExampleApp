<?php

declare(strict_types=1);

namespace App\Facades;

use App\Repository\GameRepository;
use Illuminate\Support\Facades\Facade;

class Game extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'game';
    } 
}
