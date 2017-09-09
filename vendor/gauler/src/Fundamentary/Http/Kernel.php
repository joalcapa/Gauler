<?php

namespace Fundamentary\Http;

use Fundamentary\Dir\Dir as Dir;
use Fundamentary\Http\Request as Request;
use Fundamentary\Http\Response as Response;

class Kernel {
    
    private static $kernel;
    private $request;
    private $response;
    
    private function __construct() {
        $this->request = new Request();
    }
    
    /**
     * Inicialización del objeto singleton.
     *
     * @return  object
     */
    public static function getKernel() {
        if (!self::$kernel instanceof self)
            self::$kernel = new self;
        return self::$kernel;
    }
    
    /**
     * PROHIBICIÓN DEL MÉTODO MÁGICO QUE VIOLA EL PATRON SINGLETON.
     */
    public function __clone() { killer('500'); }
    
    /**
     * PROHIBICIÓN DEL MÉTODO MÁGICO QUE VIOLA EL PATRON SINGLETON.
     */
    public function __wakeup() { killer('500'); }
    
    public function getRequest() {
        return $this->request;
    }
    
    public static function request() {
        return self::$kernel->request;
    }
    
    public static function response() {
        return self::$kernel->response;
    }
    
    public static function makeResponse($status, $data = null) {
        self::$kernel->response = new Response($status, $data);
    }
    
    public static function send() {
        self::$kernel->response->send();
    }
}