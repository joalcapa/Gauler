<?php

namespace Fundamentary\Auth\Services;

use Auth;
use Fundamentary\Dir\Dir as Dir;
use Fundamentary\Database\Kernel as kernelDB;
use Fundamentary\App\Models\UserModel as User;
use Fundamentary\Auth\Provider\JWTProvider as JWT;
use Fundamentary\Auth\Services\Service as Service;

class ServiceAuth implements Service {
    
    public static $userModel = 'Users';
    
    public static function validateAuth($request) {   
        $password = $request->input('password');
        $email = $request->input('email'); 
        $result = kernelDB::user(self::$userModel, $email, 'EMAIL');
        
        if(isset($result['password'])) 
            if(verifyBCrypt($password, $result['password'])) 
                return self::addCredentials($result); 
        
        killer('511');
    }
    
    public static function authenticate($request) {
        $config = require(Dir::config());
        $auth = $config['auth'];
        $token = $request->authorizationToken();
        
        $data = JWT::decodeCredentials($token, $auth);
        if(!isset($data->data->id) || !isset($data->data->password))
            killer('511');
        
        $result = kernelDB::verifyUser(self::$userModel, $data->data->id, $data->data->password);
        
        if(isset($result['id_rol'])) { 
            Auth::getAuth()->init($result['id'], $result['id_rol'], $result['nombre'], $result['email']); 
        } else
            killer('401');  
    }
    
    public static function resetPassword($request) { 
        $password = $request->input('password');
        $newPassword = $request->input('newPassword');
        $email = $request->input('email');
        
        $token = $request->authorizationToken();
        $config = require(Dir::config());
        $auth = $config['auth'];
        $data = JWT::decodeCredentials($token, $auth);
        
        if(!isset($data->data->id) || !isset($data->data->password))
            killer('511');
        
        if(!is_numeric($data->data->id))
            killer('401');
        
        $result = kernelDB::user(self::$userModel, $email, 'EMAIL');
        
        if(isset($result['password']))
            if(verifyBCrypt($password, $result['password'])) {
                kernelDB::updatePasswordUser(self::$userModel, hashBCrypt($newPassword), $result['id']);
                return self::addCredentials($result, hashBCrypt($newPassword));
            }
        
        killer('401');
    }
    
    public static function addCredentials($result, $password = null) { 
        if(!$password)
            $password = $result['password'];
        
        $user = new User(); 
        if(file_exists(Dir::hypermedia())) { 
            $hypermedia = require(Dir::hypermedia());
            $cont = 0;
            
            foreach($hypermedia as $hyper) {
                $cont++;
                
                if($cont == $result['id_rol']) {
                    $arrayHypermedia = [];
                    foreach($hyper as $key => $value)
                        $arrayHypermedia[$key] = str_replace('{{id_user}}', $result['id'], $value);
                    return [
                      'user' => $user->getTuples($result),
                      'token' => JWT::credentialsGrant($result['id'], $password),
                      'hypermedia' => $arrayHypermedia
                    ];
                }
            }
        }
        
        return [
               'user' => $user->getTuples($result),
               'token' => JWT::credentialsGrant($result['id'], $password)
        ];
    }
}