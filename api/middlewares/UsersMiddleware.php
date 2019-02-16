<?php

namespace Gauler\Api\Middlewares;

use Auth;
use Joalcapa\Fundamentary\App\Middlewares\BaseMiddleware as Middleware;

class UsersMiddleware extends Middleware {
    
    /**
     * Middleware asociado al método Rest 'Index', realizado
     * por el verbo http GET.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     * @return  \Fundamentary\Http\Interactions\Request\Request
     */
    public function index($request) { 
        // if(Auth::getAuth()->idRol != 1)
        //    killer('401');
        return $request;
    }
}