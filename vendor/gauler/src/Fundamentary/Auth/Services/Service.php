<?php

namespace Fundamentary\Auth\Services;

interface Service {
    
    /**
     * Validación de usuario y entrega de credenciales.
     *
     * @param  \Fundamentary\Http\Request  $request
     * @return array
     */
    public static function validateAuth($request);
    
    /**
     * Proceso de autenticación de credenciales otorgadas.
     *
     * @param  \Fundamentary\Http\Request  $request
     */
    public static function authenticate($request);
    
    /**
     * Reseteo de contraseña de usuario.
     *
     * @param  \Fundamentary\Http\Request  $request
     * @return array
     */
    public static function resetPassword($request);
    
    /**
     * Adjunción de credenciales e hypermedia.
     *
     * @param  array  $result
     * @param  string  $password
     * @return array
     */
    public static function addCredentials($result, $password = null);
}