<?php

declare(strict_types=1);

namespace App\Http\Controllers;

class RoutingController extends Controller {
    
    public function getMethod(){
        $method = 'get';
        return view('routing.method', ['MethodName' => $method]);
    }

    public function postMethod(){
        $method = 'post';
        return view('routing.method', ['MethodName' => $method]);
    }

    public function putMethod(){
            $method = 'put';
            return view('routing.method', ['MethodName' => $method]);
    }

    public function deleteMethod(){
        $method = 'delete';
        return view('routing.method', ['MethodName' => $method]);
    }
}

?>
