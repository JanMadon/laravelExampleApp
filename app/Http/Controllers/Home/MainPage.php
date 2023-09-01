<?php

declare(strict_types=1);

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class MainPage extends Controller {
    public function __invoke()
    {

        $db = \DB::connection()->getPdo(); // natywny obiekt php PDO
        dd($db);

        $connfig = config('app.name');

        return view('home.main');
    }
}


//
