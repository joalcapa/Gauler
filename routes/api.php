<?php

/*
|--------------------------------------------------------------------------
| Rutas de la API
|--------------------------------------------------------------------------
|
| Aquí se establecen las rutas de la api
| que no se encuentran asignadas a un modelo
|
*/

Api::Route('/hello', 'api@hello');

/**
 *  Si desea ejecutar un middleware antes de ejecutar el metodo del controlador
 *  el metodo Api::Route recibe como tercer parametro una funcion anonima
 *  si desea continuar con la ejecucion del metodo del controlador recuerde retornar el objeto $request
 */
/*
Api::Route('/hello', 'api@hello', function($request) {
    // killer('401');
    return $request;
});
*/

/**
 *  Si desea que un middleware agrupe varias rutas
 *  puede utilizar el metodo Middleware::Meet y pasar como primer parametro el nombre del middleware a ejecutar
 *  dicho middleware debe estar ubicado en el directorio api/middlewares
 *  note que el segundo parametro es una funcion anonima en el cual se encuentra el grupo de rutas a ejecutar
 */
/*
Middleware::Meet('api', function() {
     // Aqui puede colocar las rutas que desee
     Api::Route('/hello', 'api@hello');
});
*/
