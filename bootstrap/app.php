<?php

/*
|--------------------------------------------------------------------------
| Run aplicación
|--------------------------------------------------------------------------
|
| Gauler inicia todos los servicios para poder procesar la entrada de la 
| peticion y posteriormente ejecutarla.
| Gauler inicia los nucleos singleton necesarios para su 
| correcto funcionamiento.
|
*/

$app = new Fundamentary\App\Application(realpath(__DIR__.'/../'));

$app->addKernelSingleton(Fundamentary\Http\Kernel::class);

$app->addKernelSingleton(Fundamentary\Exception\Kernel::class);

return $app;