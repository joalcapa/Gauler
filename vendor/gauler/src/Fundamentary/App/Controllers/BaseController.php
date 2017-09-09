<?php

namespace Fundamentary\App\Controllers;

class BaseController {
    
    public function __construct() {}
    
    /**
     * Método REST, asociado al verbo http get, sin parametro requerido en la url.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     * @return  array
     */
    public function index($request) {
        return $request;
    }
    
    /**
     * Método REST, asociado al verbo http get, con parametro requerido en la url.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     * @return  array
     */
    public function show($request) {
        return $request;
    }
    
    /**
     * Método REST, asociado al verbo http post.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     */
    public function store($request) {
        
    }
    
    /**
     * Método REST, asociado al verbo http put.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     */
    public function update($request) {
        
    }
    
    /**
     * Método REST, asociado al verbo http delete.
     *
     * @param  \Fundamentary\Http\Interactions\Request\Request  $request
     */
    public function destroy($request) {
        
    }
}