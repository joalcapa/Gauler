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
 * Definición del modelo, Gauler intentará ejecutar previamente una clase
 * middleware RestFull en caso de existir, posteriormente al filtrado realizará la ejecución del controlador,
 * aquél modelo que no se establezca en este archivo, emitirá un error 404 RESOURCE NOT FOUND.
 *
 * El modelo 'users' es totalmente obligatorio para el funcionamiento 
 * del servicio de autenticación
 */
Rest::Model('users');
/**
 * Si por el contrario considera que no es necesario la ejecución
 * de una clase middleware RestFull, con todos los métodos RestFull
 * correspondientes, puede optar por la ejecución de un closure,
 * recordando retornar siempre $request, si el filtro es exitoso,
 * de lo contrario puede utilizar el mágic killer, para abortar la operación
 * con un código http que usted considere.
 */
/*
Rest::Model('users', function($request) {
    // killer('401');
    return $request;
});
*/