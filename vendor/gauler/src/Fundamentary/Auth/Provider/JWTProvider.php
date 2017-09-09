<?php

namespace Fundamentary\Auth\Provider;

use Firebase\JWT\JWT;
use Fundamentary\Dir\Dir as Dir;
use Firebase\JWT\ExpiredException as ExpiredException;
use Firebase\JWT\SignatureInvalidException as SignatureInvalidException;

class JWTProvider {
    
    /**
     * Proceso de codificación de credenciales, mediante
     * los datos parametrizados y tiempo de expiración.
     *
     * @param  int  $id
     * @param  string  $password
     * @return array
     */
    public static function credentialsGrant($id, $password) {
        $config = require(Dir::config());
        $auth = $config['auth'];
        $time = time();
        $token = [
            'iat' => $time, 
            'exp' => $time + (60*60), 
            'data' => [ 
                'id' => $id,
                'password' => $password
            ]
        ];
        return JWT::encode($token, $auth['key']);     
    }
    
    /**
     * Decodificación de credenciales, mediante llave establecida.
     *
     * @param  string  $token
     * @param  array  $auth
     * @return array
     */
    public static function decodeCredentials($token, $auth) {
        try {
            return JWT::decode($token, $auth['key'], array('HS256'));
        } catch (SignatureInvalidException $e) {
            abortAuth(SignatureInvalidException::class);
        } catch (ExpiredException $e) {
            abortAuth(ExpiredException::class);
        }
    }
}