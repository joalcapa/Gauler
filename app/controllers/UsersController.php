<?php

namespace Gauler\Api\Controllers;

use Joalcapa\Fundamentary\App\Controllers\BaseController as Controller;
use Gauler\Api\Models\UsersModel as User;

class UsersController extends Controller {
    
    /**
     * Middleware asociado al método Rest 'Index', realizado
     * por el verbo http GET.
     *
     * Index => return array GET http://.../users
     * Show => return array GET http://.../users/{$id}
     * Store => POST http://.../users
     * Update => PUT http://.../users/{$id}
     * Destroy => DELETE http://.../users/{$id}
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     * @return  array
     */
    public function index($request) {
        $users = User::all();
        return $users;
    }
}
