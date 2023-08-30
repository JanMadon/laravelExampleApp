<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        // $myTestEnv = env('MY_TEST_ENV'); // dnie odnosimy się bezposrednio do ZŚ z env
        $myTestEnv = config('test.testEnv'); // tylko przez config
        dump($myTestEnv);

        $myTestEnv =config(); // zawiera calą konfiguracje z katalogu config
        dump($myTestEnv);

        $myTestEnv =config('app.name'); // zawiea config katalogu app, wartość name 
        dump($myTestEnv);
        // return view('home.main');
    }
}
