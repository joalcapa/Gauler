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

$app = new Joalcapa\Fundamentary\App\Application(realpath(__DIR__.'/../'));

$app->addKernelSingleton(Joalcapa\Fundamentary\Http\Kernel::class);

$app->addKernelSingleton(Joalcapa\Fundamentary\Exception\Kernel::class);

return $app;
