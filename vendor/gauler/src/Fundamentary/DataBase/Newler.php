<?php

namespace Fundamentary\Database;

class Newler {
    
    private $driverDB;
    
    public function __construct($driverDB) {
        $this->driverDB = $driverDB;
        $this->driverDB->connect();
    }
    
    public function user($model, $parameter, $parameterString) {
        return $this->driverDB->user($model, $parameter, $parameterString);
    }
    
    public function verifyUser($model, $id, $password) {
        if(is_numeric($id))
            return $this->driverDB->verifyUser($model, $id, $password);
        killer('400');
    }
    
    public function updatePasswordUser($model, $password, $id) {
        if(is_numeric($id))
            $this->driverDB->updatePasswordUser($model, $password, $id);
        else
            killer('400');
    }
    
    public function find($model, $id) {
        if(is_numeric($id))
            return $this->driverDB->find($model, $id);
        killer('400');
    }
    
    public function all($model) { 
        return $this->driverDB->all($model);
    }
    
    public function where($model, $where) {
        return $this->driverDB->where($model, $where);
    }
    
    public function update($data, $tuples, $model, $id) {
        if(is_numeric($id))
            $this->driverDB->update($data, $tuples, $model, $id);
        else
            killer('400');
    }
    
    public function save($data, $tuples, $model) { 
        $this->driverDB->save($data, $tuples, $model);
    }
    
    public function destroy($model, $id) {
        if(is_numeric($id))
            $this->driverDB->destroy($model, $id);
        else
            killer('400');
    }
    
    public function typeWhere($typeWhere, $attribute, $value = null) {
        return $this->driverDB->typeWhere($typeWhere, $attribute, $value);
    }
}