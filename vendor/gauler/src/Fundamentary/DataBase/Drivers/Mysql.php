<?php

namespace Fundamentary\Database\Drivers;

use Fundamentary\Database\Drivers\DriverDB as DriverDB;

class Mysql implements DriverDB {
    
    private $mysqli;
    private $config;
    
    public function __construct($config) {
        $this->config = $config;
    }
    
    public function connect() {
        $this->mysqli = mysqli_connect(
            $this->config['host'],
            $this->config['user'],
            $this->config['password'],
            $this->config['db']
        );
        
        if (mysqli_connect_errno($this->mysqli))
            killer('500');
        
        mysqli_set_charset($this->mysqli, "utf8");
    }
    
    public function query($query, $isReturn = true) {
        if($isReturn) {
            $result =  mysqli_query($this->mysqli, $query);
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }
        mysqli_query($this->mysqli, $query);
    }
    
    public function close() {
        mysqli_close();
    }  
    
    public function user($model, $parameter, $parameterString) {
        return $this->query(
            "SELECT * FROM ".$model
            ." WHERE ".$parameterString." = '".$parameter
            ."';");
    }
    
    public function verifyUser($model, $id, $password) {
        return $this->query(
            "SELECT * FROM ".$model
            ." WHERE ID = '".$id
            ."' AND PASSWORD = '".$password
            ."';"); 
    }
    
    public function updatePasswordUser($model, $password, $id) {
        $this->query(
            "UPDATE LOW_PRIORITY ".$model
            ." SET PASSWORD = '".$password
            ."' WHERE ID = '".$id
            ."'", false);
    }
    
    public function all($model) {
        $result =  mysqli_query($this->mysqli, "SELECT * FROM ".$model); 
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function where($model, $where) {
        $query = ' WHERE ';
        $isAdd = false;
        foreach ($where as $item) {
            if($isAdd)
                $query = $query.' AND ';
            $query = $query.$item;
            $isAdd = true;
        }
        $result =  mysqli_query($this->mysqli, "SELECT * FROM ".$model.$query); 
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    
    public function typeWhere($typeWhere, $attribute, $value = null) { 
        switch($typeWhere) {
            case 'NOT_NULL':
                return $attribute.' IS NOT NULL ';
            case 'NOT_EQUALS':
                return $attribute." != '".$value."' ";
            case 'EQUALS':
                return $attribute." = '".$value."' ";
            default:
                break;
        }
    }
    
    public function update($data, $tuples, $model, $id) { 
        $isAdd = false;
        $query = 'UPDATE LOW_PRIORITY '.$model.' SET ';
        
        foreach($tuples as $tuple) { 
            if($isAdd && isset($data->$tuple))
                $query = $query.', ';
            if(isset($data->$tuple)) {
                $isAdd = true;
                $query = $query.$tuple."='".$data->$tuple."'";
            }
        }
            
        $query = $query." WHERE ID='".$id."'";
        $this->query($query, false);
    }
    
    public function save($data, $tuples, $model) { 
        $isAdd = false;
        $query = 'INSERT INTO '.$model.' (';
        
        foreach($tuples as $tuple) { 
            if($isAdd && isset($data->$tuple))
                $query = $query.', ';
            if(isset($data->$tuple)) {
                $isAdd = true;
                $query = $query.$tuple;
            }
        }
        
        $query = $query.') VALUES (';
        $isAdd = false;
        
        foreach($tuples as $tuple) { 
            if($isAdd && isset($data->$tuple))
                $query = $query.', ';
            if(isset($data->$tuple)) {
                $isAdd = true; 
                $query = $query."'".$data->$tuple."'";
            }
        }
          
        $query = $query.')';
        $this->query($query, false);
    }
    
    public function find($model, $id) {
        return $this->query("SELECT * FROM '.$model.' WHERE id='".$id."' LIMIT 1");
    }
    
    public function destroy($model, $id) {
        $this->query("DELETE FROM '.$model.' WHERE id='".$id, false);
    }
}