<?php

namespace Fundamentary\Database\Drivers;

interface DriverDB {
    
    /**
     * Método DB SQL, para iniciar la conexion con el gestor de la base de datos destino.
     */
    public function connect();
    
    /**
     * Método DB SQL, para realizar una consulta SQL, con o sin retorno de datos.
     *
     * @param  string  $query
     * @param  boolean  $isReturn
     * @return array
     */
    public function query($query, $isReturn = true);
    
    /**
     * Método DB SQL, para cerrar la conexion con el gestor de la base de datos destino.
     */
    public function close();
    
    /**
     * Método DB SQL, para obtener un usuario.
     *
     * @param  string  $model
     * @param  string  $parameter
     * @param  string  $parameterString
     * @return  array
     */
    public function user($model, $parameter, $parameterString);
    
    /**
     * Método DB SQL, para obtener un usuario.
     *
     * @param  string  $model
     * @param  int  $id
     * @param  string  $password
     * @return  array
     */
    public function verifyUser($model, $id, $password);
    
    /**
     * Método DB SQL, para actualizar la contraseña de un determinado usuario.
     *
     * @param  string  $model
     * @param  string  $password
     * @param  int  $id
     */
    public function updatePasswordUser($model, $password, $id);
    
    /**
     * Método DB SQL, que obtener la syntaxis del gestor de base de datos destino.
     *
     * @param  string  $typeWhere
     * @param  string  $attribute
     * @param  string  $value
     * @return  string
     */
    public function typeWhere($typeWhere, $attribute, $value = null);
    
    /**
     * Método DB SQL, que permite obtener una colección de objetos, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  string  $model
     * @return  array
     */
    public function all($model);
    
    /**
     * Método DB SQL, que permite obtener un objeto, o colección de objetos relacionales, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  string  $model
     * @param  array  $where
     * @return  array
     */
    public function where($model, $where);
    
    /**
     * Método DB SQL, que permite actualizar un objeto relacional, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  object  $data
     * @param  array  $tuples
     * @param  string  $model
     * @param  int  $id
     */
    public function update($data, $tuples, $model, $id);
    
    /**
     * Método DB SQL, que permite guardar un objeto relacional, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  object  $data
     * @param  array  $tuples
     * @param  string  $model
     */
    public function save($data, $tuples, $model);
    
    /**
     * Método DB SQL, que permite buscar un objeto relacional, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  string  $model
     * @param  int  $id
     * @return  array
     */
    public function find($model, $id);
    
    /**
     * Método DB SQL, que permite eliminar un objeto relacional, perteneciente al modelo Rest en la base de datos destino.
     *
     * @param  string  $model
     * @param  int  $id
     */
    public function destroy($model, $id);
}