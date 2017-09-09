<?php

namespace Fundamentary\Http\Interactions\Request;

class Request {
    
    public $id;
    public $idRelational;
    
    private $inputs;
    
    public function __construct($inputs, $idRelational, $id) {
        $this->id = $id;
        $this->inputs = $inputs;
        $this->idRelational = $idRelational;
    }
    
    /**
     * Retorno de la variable enviada por el cliente.
     *
     * @return  string
     */
    public function input($input) {
        if(isset($this->inputs->$input)) 
            return $this->inputs->$input;
        return null;
    }
}