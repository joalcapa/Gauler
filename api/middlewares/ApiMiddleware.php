<?php

namespace Gauler\Api\Middlewares;

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
|
| El metodo middle recibe como parametro el objeto $request de la solicitud HTTP
| ademas recibe como segundo parametro el objeto $next, el cual es la funcion de acceso
| para ejecutar las rutas de la api o los modelos REST
| si desea impedir la ejecucion de las rutas o de los modelos, puede llamar al metodo killer
| para abortar la operacion con el codigo http que considere
|
*/

class ApiMiddleware {

    public function middle($request, $next) {
        // killer(401);
        $next();
    }
}