<?php

namespace Fundamentary\Rest;

use Auth;
use Fundamentary\Dir\Dir as Dir;

class Rest {
    
    /**
     * Inicialización del método model, del proceso RestFull.
     *
     */
    public static function apply() {
        file_exists(Dir::rest()) ? require_once(Dir::rest()) : killer('500');
    }  
    
    /**
     * Capa de filtración de acuerdo a los métodos RestFull otorgados en los roles de usuarios.
     *
     * @param  \Fundamentary\Http\Request  $request
     * @param  string  $typeAction
     * @param  string $model
     */
    public static function activeRoles($request, $typeAction, $model) { 
        if(file_exists(Dir::roles())) {
            $roles = require(Dir::roles());
            $cont = 0;

            foreach($roles as $rol) {
                $cont++;
                if($cont == Auth::getAuth()->idRol)
                    $rolActive = $rol;
            }
        
            if(!isset($rolActive))
                killer('401');
            
            if(array_key_exists($typeAction, $rolActive)) { 
                $rolModels = $rolActive[$typeAction];
                foreach($rolModels as $rolModel)
                    if(strtolower($rolModel) == strtolower($model))
                        return;
            }
            
            killer('401');
        }
    }
}