<?php
/*
|--------------------------------------------------------------------------
| Rutas web
|--------------------------------------------------------------------------
|
| Aquí se establecen las rutas web
| rutas publicas sin autenticacion de usuario
|
*/

/**
 * Al igual que Rest, puede ejecutar una funcion anonima
 * en la cual ejecuta su logica de negocios.
 */
Web::get('route', function($request) {
    // killer('401');
    $data = [];
    return $data;
});

/**
 * Si por el contrario requiere de la ejecucion de un controlador
 * puede determinar como segundo parametro el nombre del controlador
 * seguido del metodo que ejecuta la logica de negocios.
 */
Web::get('route', 'controller@method');
