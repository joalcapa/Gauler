<?php
/*
|--------------------------------------------------------------------------
| Modelos Rest
|--------------------------------------------------------------------------
|
| Aquí se establecen los modelos Rest.
| Gauler evaluará la existencia del modelo y controlador
| para realizar la ejecución correspondiente
|
*/

/**
 * El modelo 'users' es totalmente obligatorio para el funcionamiento 
 * del servicio de autenticación
 */
Rest::Model('users');

/**
 *  Si desea ejecutar un middleware antes de ejecutar la operacion REST del modelo
 *  el metodo Rest::Model recibe como segundo parametro una funcion anonima
 *  si desea continuar con la ejecucion de la operacion REST del modelo recuerde retornar el objeto $request
 */
/*
Rest::Model('users', function($request) {
    // killer('401');
    return $request;
});
*/

/**
 *  Si desea que un middleware agrupe varios modelos
 *  puede utilizar el metodo Middleware::Meet y pasar como primer parametro el nombre del middleware a ejecutar
 *  dicho middleware debe estar ubicado en el directorio api/middlewares
 *  note que el segundo parametro es una funcion anonima en el cual se encuentra el grupo de modelos a ejecutar
 */
/*
Middleware::Meet('api', function() {
     // Aqui puede colocar los modelos que desee
     Rest::Model('users');
});
 */