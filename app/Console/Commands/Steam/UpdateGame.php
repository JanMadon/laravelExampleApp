<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;

class UpdateGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'steam:update-game {game?}'; // argument może być pusty
    //protected $signature = 'steam:update-game {game=FIFA}'; // domyslna wartość argumentu 
    protected $signature = 'steam:update-game {game}'; // agrument jest wymagany 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $game = $this->argument('game');
        dump($game);

        //$answer = $this->ask('czy to twoja ulubiona gra?'); // pyta uzytkownika i odpowiedz zapisuje do zmienej 
        //dump($answer);

        //$confirm = $this->confirm('Czy na pewno?');
        //dump($confirm);

        // tak można wyświetlić wiadomosci uzytkownikowi (rózne kolory:)
        $this->error('error ...');
        $this->question('question ...');
        $this->comment('comment ...');
        $this->info('info ...');
        $this->line('line ...');
    }
}
