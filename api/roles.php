<?php
/*
|--------------------------------------------------------------------------
| Roles de usuario
|--------------------------------------------------------------------------
|
| Aquí se establecen los roles Rest, para los usuarios.
| Recuerde que Gauler, identifica el atributo 'id_rol', de la relación del
| modelo users, siendo el estudio de forma jerarquica, de esta manera,
| el super usuario, tendrá el primer array.
| Además de esto, tendrá acceso
| a los modelos que se registran en su array, de lo contrario
| Gauler emitirá un error 401 NOT AUTORIZED.
*/
return [
    'SuperUser' => [
        'Index' => [
            'Users',
        ],
        'Show' => [
            'Users',
        ],
        'Store' => [
            'Users',
        ],
        'Update' => [
            'Users',
        ],
        'Delete' => [
            'Users',
        ]
    ],
];