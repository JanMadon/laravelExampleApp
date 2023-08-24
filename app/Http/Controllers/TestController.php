<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
    // php artisan make:controller TestController
    public function test() {
        dump('text z controllera TestController');
    }
}
