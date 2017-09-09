<?php

/*
|--------------------------------------------------------------------------
| Modelo Hypermedia
|--------------------------------------------------------------------------
|
| Aquí se establecen todos los vínculos de hypermedia
| para la correcta navegación de la api.
|
| Recuerde siempre mantener los vínculos 'urlPassword' y 'urlUsers'
| para el correcto funcionamiento de Auth, Auth funcioná mediante 
| el atributo $id del usuario, puesto que sustituye el espacio de nombre
| {{id_user}} por el $id del estado temporal, puesto que Gauler no almacena
| sesion alguna.
*/

return [
    'SuperUser' => [
        'urlPassword' => env('HOST_API','http://localhost/app/public').'/api/users/{{id_user}}/resetpassword',
        'urlUsers' => env('HOST_API','http://localhost/app/public').'/api/users/{{id_user}}',
    ]
];