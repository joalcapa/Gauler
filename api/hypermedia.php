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
|
| Además a esto, Gauler enviará los vínculos de hypermedia, utilizando
| siempre el protocolo HTTPS SEGURO, por lo que el servidor de producción
| deberá tener los certificados SSL para el protocolo HTTPS SEGURO,
| ya que Gauler siendo una api RestFull, trabajará en el puerto 443,
| recuerde colocar solo el dominio con o sin www, el protocolo será ajustado por Gauler,
| por DEFAULT, Gauler edita el archivo .htacces, para redireccionar a HTTPS,
| por lo que debes verificar que el modulo Rewrite este habilitado,
| por default muchos servidores de producción lo mantienen habilitado.
*/
return [
    'SuperUser' => [
        'urlPassword' => env('HOST_API','localhost/app/public').'/api/users/{{id_user}}/resetpassword',
        'urlUsers' => env('HOST_API','localhost/app/public').'/api/users/{{id_user}}',
    ]
];