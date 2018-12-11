<?php

namespace Gauler\Api\Models;

use Joalcapa\Fundamentary\App\Models\BaseModel as Model;

class UsersModel extends Model {
    
    public static $model = 'Users';
    
    protected $tuples = [
        'name',
        'email',
        'password'
    ]; 
    
    protected $hidden_tuples = [
        'password'
    ];
}
