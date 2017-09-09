<?php

namespace Api\Models;

use Fundamentary\App\Models\BaseModel as Model;

class UsersModel extends Model {
    
    public static $model = 'Users';
    
    protected $tuples = [
        'nombre',
        'email',
        'password',
        'id_rol'
    ]; 
    
    protected $hidden_tuples = [
        'password'
    ];
}