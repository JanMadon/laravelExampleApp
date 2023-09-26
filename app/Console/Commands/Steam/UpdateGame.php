<?php

namespace App\Console\Commands\Steam;

use Illuminate\Console\Command;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

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

    private $httpClient;

    public function __construct(Factory $httpClient)
    {
        parent::__construct();
        $this->httpClient = $httpClient;
    }

    /**
     * Execute the console command.
     * 
     */
    public function handle()
    {
        /* 
            $response = Http::get('http://postman-echo.com/get', [    // PRZEZ FASADE
                    'foo' => 'bar',
                    'dupa' => 'cycki'
                ]);
        */
        $response = $this->httpClient -> get('http://postman-echo.com/get', [  // PRZEZ DEPENDENCY INECTION
            'foo' => 'bar',
            'dupa' => 'cycki'
        ]);
        $responsePost = $this->httpClient -> post('http://postman-echo.com/post', [  // PRZEZ DEPENDENCY INECTION
            'foo' => 'bar',
            'dupa' => 'cycki'
        ]);

        // $response->body()
        // $response->json()
        // $response->status()
        // $response->ok()
        // $response->successful()
        // $response->failed()
        // $response->headers()

        dump($response->json());
    }


    public function handle_old()
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
