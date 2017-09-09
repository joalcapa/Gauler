<?php

namespace Fundamentary\App\Models;

use Fundamentary\Http\Kernel as kernelHttp;
use Fundamentary\Database\Kernel as KernelDB;

class BaseModel {
    
    public function __construct() {
    }
    
    /**
     * Método ORM, que permite guardar el objeto relacional, perteneciente al modelo Rest en la base de datos destino.
     */
    public function save() { 
        KernelDB::save($this, $this->tuples, static::$model);
    }
    
    /**
     * Método ORM, que permite actualizar el objeto relacional, perteneciente al modelo Rest ó al modelo en la base de datos destino.
     *
     * @param  int  $id
     */
    public function update($id = null) {
        if($id)
            KernelDB::update($this, $this->tuples, static::$model, $id);
        else
            KernelDB::update($this, $this->tuples, static::$model, kernelHttp::request()->getRequiredParameter());
    }
    
    /**
     * Método ORM, que permite obtener una colección de objetos, pertenecientes al modelo Rest en la base de datos destino.
     *
     * @return  array
     */
    public static function all() {
        return KernelDB::all(static::$model);
    }
    
    /**
     * Método ORM, que permite obtener un objeto, perteneciente al modelo Rest en la base de datos destino.
     * 
     * @param  int  $id
     * @return  array
     */
    public static function find($id) { 
        return KernelDB::find(static::$model, $id);
    }
    
    /**
     * Método ORM, que permite obtener un objeto o colección de objetos, de acuerdo a las condiciones
     * ingresadas como un array asociativo, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  array  $where
     * @return  array
     */
    public static function where($where) { 
        return KernelDB::where(static::$model, $where);
    }
    
    /**
     * Método ORM, que permite eliminar un objeto, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  int  $id
     */
    public static function destroy($id) {
        KernelDB::destroy(static::$model, $id);
    }
    
    /**
     * Método ORM, que permite obtener la syntaxis del gestor de base de datos destino.
     *
     * @param  string  $attribute
     * @return  string
     */
    public static function NOT_NULL($attribute) {
        return KernelDB::TypeWhere('NOT_NULL', $attribute);
    }
    
    /**
     * Método ORM, que permite obtener la syntaxis del gestor de base de datos destino.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return  string
     */
    public static function NOT_EQUALS($attribute, $value) {
        return KernelDB::TypeWhere('NOT_EQUALS', $attribute, $value);
    }
    
    /**
     * Método ORM, que permite obtener la syntaxis del gestor de base de datos destino.
     *
     * @param  string  $attribute
     * @param  string  $value
     * @return  string
     */
    public static function EQUALS($attribute, $value) {
        return KernelDB::TypeWhere('EQUALS', $attribute, $value);
    }
}