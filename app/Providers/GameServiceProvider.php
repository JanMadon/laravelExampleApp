<?php
// php artisan make:provider GameSreviceProvider
namespace App\Providers;

use App\Repository\Eloquent\GameRepository as EloquentGameRepostory;
use App\Repository\GameRepository;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void // jest wskazany tylko do bindowania
    {
        // bind wiąże dany interfejs z jego inplemetacją
        $this->app->bind(
            GameRepository::class, EloquentGameRepostory::class
            // to tego interfejsu , urzywaj tej implemenatcji
            // pod spodem: return new EloquentGameRepostory(new GameModel(..));
        );

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
