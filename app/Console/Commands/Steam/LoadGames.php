<?php
// tworzenie komędy artisanowej
// php artisan make:command Steam\LoadSteamGames

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;

class LoadGames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'steam:load-games';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Steam - load games';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dump('kod do wykonania');
    }
}
