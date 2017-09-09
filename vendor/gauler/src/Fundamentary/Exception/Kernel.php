<?php

namespace Fundamentary\Exception;

use Fundamentary\Dir\Dir as Dir;

class Kernel {
    
    private static $kernel;
   
    private function __construct() {}
    
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
    
    /**
     * Generación de respuesta a una excepción.
     *
     * @param  \Fundamentary\Exception\Exceptions\{Exception}  $exception
     * @param  \Fundamentary\App\Application  $app
     */
    public function handlerException($exception, $app) {
        $data = $exception->getData();
        $app->makeResponse($data);
    }
}