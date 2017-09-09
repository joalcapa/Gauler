<?php

namespace Fundamentary\App\Middlewares;

use Fundamentary\Rest\Rest as Rest;

class BaseMiddleware {
    
    public function __construct() {
    }
    
    /**
     * Filtrado realizado por medio de la elección del método Rest, según el verbo http.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     * @param  string  $model
     * @param  string  $method
     * @return  \Fundamentary\Http\Interactions\Request\Request
     */
    public function apply($request, $model, $method, $id) {  
        switch($method) { 
            case 'POST':
                Rest::activeRoles($request, 'Store', $model);
                $data = $this->store($request);
                break;
            case 'PUT':
                Rest::activeRoles($request, 'Update', $model);
                $data = $this->update($request);
                break;
            case 'DELETE':
                Rest::activeRoles($request, 'Delete', $model);
                $data = $this->destroy($request);
                break;
            default: 
                $id ? Rest::activeRoles($request, 'Show', $model) : Rest::activeRoles($request, 'Index', $model); 
                $id ? $data = $this->show($request) : $data = $this->index($request);
                break;
        }
       
        return $data;
    }
    
    public function Index($request) {
        return $request;
    }
    
    public function Show($request) {
        return $request;
    }
    
    public function Store($request) {
        return $request;
    }
    
    public function Update($request) {
        return $request;
    }
    
    public function Destroy($request) {
        return $request;
    } 
}