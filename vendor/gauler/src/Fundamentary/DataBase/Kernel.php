<?php

namespace Fundamentary\Database;

use Fundamentary\Dir\Dir as Dir;
use Fundamentary\Database\Newler as Newler;

class Kernel {
    
    private static $kernel;
    private $providerORM;
    private $driver;
    
    /**
     * Inicialización del driver del gestor de base de datos destino, e inyección de dependencia al ORM.
     */
    private function __construct() {
        $this->driver = $this->driver();
        $this->providerORM = new Newler($this->driver);
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
    
    /**
     * Método DB SQL, para realizar una consulta SQL, con o sin retorno de datos.
     *
     * @param  string  $query
     * @param  boolean  $isReturn
     * @return array
     */
    public static function queryBuilder($query, $isReturn = true) {
        return self::$kernel->driver->query($query, $isReturn);
    }
    
    /**
     * Factoría del objeto driverDB, de acuerdo a una configuración establecida.
     *
     * @return object
     */
    private function driver() {
        $config = require(Dir::config());
        $db = $config['database'];
        
        switch(strtolower($db['driver'])) {
            case 'mysql':
                $driver = Dir::driverDatabase(ucwords(strtolower($db['driver'])));
                break;
            default:
                $driver = Dir::driverDatabase(ucwords(strtolower($db['driver'])));
                break;
        }
        
        return new $driver($db);
    }
    
    public static function user($model, $parameter, $parameterString) {
        return self::$kernel->providerORM->user($model, $parameter, $parameterString);
    }
    
    public static function verifyUser($model, $id, $password) {
        return self::$kernel->providerORM->verifyUser($model, $id, $password);
    }
    
    public static function updatePasswordUser($model, $password, $id) {
        self::$kernel->providerORM->updatePasswordUser($model, $password, $id);
    }
    
    public static function all($model) { 
        return self::$kernel->providerORM->all($model);
    }
    
    public static function where($model, $where) {
        return self::$kernel->providerORM->where($model, $where);
    }
    
    public static function update($data, $tuples, $model, $id) {   
        self::$kernel->providerORM->update($data, $tuples, $model, $id);
    }
    
    public static function save($data, $tuples, $model) {   
        self::$kernel->providerORM->save($data, $tuples, $model);
    }
    
    public static function destroy($model, $id) {
        self::$kernel->providerORM->destroy($model, $id);
    }
    
    public static function typeWhere($typeWhere, $attribute, $value = null) { 
        return self::$kernel->providerORM->typeWhere($typeWhere, $attribute, $value);
    }
    
    public static function find($model, $id) {
        return self::$kernel->providerORM->find($model, $id);
    }
}