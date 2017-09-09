<?php

namespace Fundamentary\Exception\Exceptions;

use Exception;

class DriverException extends Exception {
    
    private $data;
    
    /**
     * Inicialización de la excepción.
     *
     * @param  string  $message
     * @param  int  $code
     */
    public function __construct($message, $code = 0) {
        $this->data = $code;
        parent::__construct($message, $code);
    }

    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
    
    public function getData() {
        return $this->data;
    }  
    
}