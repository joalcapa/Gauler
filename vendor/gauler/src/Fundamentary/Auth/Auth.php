<?php

namespace Fundamentary\Auth;

use Fundamentary\Auth\Services\ServiceAuth as ServiceAuth;

class Auth {
    
    /**
     * Capa de autenticación, credenciales otorgadas, reseteo de contraseña de usuario.
     *
     * @param  \Fundamentary\Http\Request  $request
     * @return data
     */
    public static function initAuth($request) { 
        if($request->getRequiredParameter())
            if(!is_numeric($request->getRequiredParameter()))
                killer('400');
        
        if($request->getRelationalParameter())
            if(!is_numeric($request->getRelationalParameter()))
                killer('400');
        
        if($request->isLogin()) 
            return ServiceAuth::validateAuth($request); 
        if($request->isResetPassword())
            return ServiceAuth::resetPassword($request);
        ServiceAuth::Authenticate($request); 
        return null;
    }
}