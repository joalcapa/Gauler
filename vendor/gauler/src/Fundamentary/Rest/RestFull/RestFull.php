<?php

use Fundamentary\Dir\Dir as Dir;
use Fundamentary\Rest\Rest as Rest;
use Fundamentary\Http\Kernel as KernelHttp;

class RestFull {
    
    /**
     * Evaluación del modelo Rest.
     *
     * @param  string  $model
     * @param  function  $closure
     */
    public static function model($model, $closure = null) {
        $model = ucwords(strtolower($model));
        $request = KernelHttp::request();
        if($request->getModel() == $model) 
            self::explorer($model, $closure, $request);        
    }
    
    /**
     * Exploración de los recursos existentes del modelo Rest.
     *
     * @param  string  $model
     * @param  function  $closure
     * @param  \Fundamentary\Http\Request  $request
     */
    public static function explorer($model, $closure = null, $request) { 
        $data = $request->getInteractionsRequest(); 
       
        if(file_exists(Dir::model($model)) && file_exists(Dir::controller($model))) {  
            require_once(Dir::model($model));
            require_once(Dir::controller($model));
           
            if(!$closure) {
                if(file_exists(Dir::middleware($model))) { 
                    require_once(Dir::middleware($model));
                    $route = Dir::apiMiddlewares($model);
                    $middleware = new $route();
                    $data = $middleware->apply($data, $model, $request->method(), $request->getRequiredParameter()); 
                }
            } else 
                $data = call_user_func_array(
                $closure,
                array(
                    'request' => $data,
                ));
                
            if($data === $request->getInteractionsRequest())
                self::make($model, $request);  
        } else 
            killer('401');
    }
    
    /**
     * Preparación del controlador del modelo Rest.
     *
     * @param  string  $model
     * @param  \Fundamentary\Http\Request  $request
     */
    public static function make($model, $request) { 
        $routeController = Dir::apiControllers($model);
        self::execute(new $routeController(), $model, $request);
    }
    
    /**
     * Ejecución del metodo RestFull del controlador Rest.
     *
     * @param  \Api\Controllers\{$model}.Controller  $controller
     * @param  string  $model
     * @param  \Fundamentary\Http\Request  $request
     */
    public static function execute($controller, $model, $request) {   
        switch($request->method()) { 
            case 'POST':
                Rest::activeRoles($request, 'Store', $model);
                $controller->store($request->getInteractionsRequest());
                KernelHttp::makeResponse('201');
                break;
            case 'PUT':
                Rest::activeRoles($request, 'Update', $model);
                $controller->update($request->getInteractionsRequest());
                KernelHttp::makeResponse('200');
                break;
            case 'DELETE':
                Rest::activeRoles($request, 'Delete', $model);
                $controller->destroy($request->getInteractionsRequest());
                KernelHttp::makeResponse('200');
                break;
            default: 
                $request->getRequiredParameter() ? Rest::activeRoles($request, 'Show', $model) : Rest::activeRoles($request, 'Index', $model);
                $request->getRequiredParameter() ? $data = $controller->show($request->getInteractionsRequest()) : $data = $controller->index($request->getInteractionsRequest()); 
                KernelHttp::makeResponse('200', $data);
                break;
        } 
    }
}