<?php

declare(strict_types=1);

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MoveController extends Controller {

    public function printMethodInfo(Request $request) {
        
    }

    public function list(Request $request, int $id) {
        
        dump($id);

        if($request->isMethod('get')){
            dump('to jest z metody get');

            $query = $request->query();
            $all = $request->all();
            $input = $request->input();
            dump($query, $all, $input);
        }
        if($request->isMethod('post')){
            dump('to jest z metody post');

            $query = $request->query();
            $all = $request->all();
            $input = $request->input();
            dump($query, $all, $input);
        }
        if($request->isMethod('put')){
            dump('to jest z metody put');

            $query = $request->query();
            $all = $request->all();
            $input = $request->input();
            dump($query, $all, $input);
        }
        if($request->isMethod('delete')){
            dump('to jest z metody delete');

            $query = $request->query();
            $all = $request->all();
            $input = $request->input();
            dump($query, $all, $input);
        }

        // 
    }

    
}