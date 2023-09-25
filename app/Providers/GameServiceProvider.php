<?php
// php artisan make:provider GameSreviceProvider
namespace App\Providers;

use App\Models\Game;
use App\Repository\Eloquent\GameRepository as EloquentGameRepostory;
use App\Repository\GameRepository;
use App\Service\FakeService;
use Illuminate\Support\ServiceProvider;

class GameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void // jest wskazany tylko do bindowania
    {
        /*
        // bind wiąże dany interfejs z jego inplemetacją
        $this->app->bind(
            GameRepository::class, EloquentGameRepostory::class
            );
            // to tego interfejsu , urzywaj tej implemenatcji
            // pod spodem: return new EloquentGameRepostory(new GameModel(..));
        */

        /*
        $this->app->bind(
            GameRepository::class,
            function ($app) { // z Closure (callback) tylko jeśli przekazujemy jakis dodatkowy parametr, tutaj  nie trzeba

                return new EloquentGameRepostory(
                   $app->make(Game::class) // new Game() <- to to samo
                );
            }
        );
        */

        //test:

        $this->app->bind(
            GameRepository::class,
            function ($app) {
                $config = 'test';
                $fakeService = $this->app->make(FakeService::class);
                $gameModel = $app->make(Game::class);

                //$fakeService = new FakeService('ddd');

                return new EloquentGameRepostory($gameModel, $fakeService);
            }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        // jeśli wyciągamy coś poza callback, (coś co ma być wykonane tylko 1 raz) 
        //uzywamy boot a nie register:
        $fakeService = $this->app->make(FakeService::class); // pzekazujemy przez USE do callbacka

        $this->app->bind(
            GameRepository::class,
            function ($app) use ($fakeService) {
                $config = 'test';
                dump($config);
                $gameModel = $app->make(Game::class);

                //$fakeService = new FakeService('ddd');

                return new EloquentGameRepostory($gameModel, $fakeService);
            }
        );
    }
}
