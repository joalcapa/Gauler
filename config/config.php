<?php

/*
|--------------------------------------------------------------------------
| DATOS DE CONFIGURACIÓN
|--------------------------------------------------------------------------
|
| Recuerde llenar el array con los datos correspondientes,
| para mayor seguridad inicié los datos en el archivo
| de variables de entorno .env, que se encuentrá en la
| ruta raíz principal del proyecto.
|
*/

return [
    'database' => [
        'driver' => env('DRIVER_DB', 'MySql'),
        'host' => env('HOST_DB', 'localhost'),
        'port' => env('PORT_DB', '3306'),
        'user' => env('USER_DB', 'root'),
        'password' => env('PASSWORD_DB', ''),
        'db' => env('DATABASE_DB', ''),
    ],
    'auth' => [
        'key' => env('KEY_AUTH', 'my_key_secret'),
    ],
    'api' => [
        'version' => 1
    ]
];