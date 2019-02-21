# Gauler
Api standar RestFul by Jose Caceres

[¿Que es REST?](#hablemos-un-poco-de-las-apis-restFul)  
[¿Que es Gauler?](#api-gauler)  
[Instalacion y configuracion](#instalacion)  
[Modelos](#que-vuelvan-los-heroes)  
[Rutas](#rutas-del-modelo)  
[Controladores](#controlador-del-modelo)  
[CRUD automatico](#crud-automatico)  
[Autenticacion](#autenticacion)  
[Gaulerium CLI](#gaulerium-cli)  

## Hablemos un poco de las apis RestFul
Existen diversos servicios web como lo son SOAP, GraphQL entre otros.
Pero REST es el servicio web popular por excelencia, muchos sistemas y frameworks trabajan bajo esta arquitectura, aproximadamente en el 
año 2000, Roy Fielding propone este nuevo servicio web.

Las caracteristicas son muchas y existen muchos foros y blogs donde se habla al respecto, la primera fuente a consultar 
es la misma de Roy Fielding, en su [trabajo](https://www.ics.uci.edu/~fielding/pubs/dissertation/top.htm) acerca de Rest,
algo mas ligero y rapido lo puedes encontrar en el siguiente [articulo](http://asiermarques.com/2013/conceptos-sobre-apis-rest/), en este articulo
Asier Marqués describe todas las caracteristicas escenciales para una arquitectura REST.

#### Metodos RestFul
Son muy sencillos de explicar, basicamente es una convencion de nombres para ejecutar una determinada logica rest,
estan establecidos para ser ejecutados por medio de una URI y un metodo especifico:

##### 1. Index:  
   Metodo:      GET  
   URI:         /resources  
   Accion:      Listar recursos  
   
##### 2. Show:  
   Metodo:      GET  
   URI:         /resources/{id}  
   Accion:      Obtener el recurso mediante un id especifico  
   
##### 3. shop:  
   Metodo:      POST  
   URI:         /resources  
   Accion:      Crear un nuevo recurso  
   
##### 4. Update:   
   Metodo:      PUT  
   URI:         /resources/{id}  
   Accion:      Actualizar el recurso mediante un id especifico  
   
##### 5. Delete:  
   Metodo:      DELETE  
   URI:         /resources/{id}  
   Accion:      Eliminar el recurso mediante un id especifico 
   
#### Metodos RestFul relacionales
Los metodos antes descritos responden a operaciones CRUD en modelos unicos, los cuales no dependen de relaciones con ningun 
otro modelo, pero en el desarrollo de api`s, siempre trabajamos con modelos que tienen relaciones con otros modelos, 
bien sea relacion de uno a uno, uno a muchos y muchos a muchos, REST define una manera de definir endpoints considerando 
la relacion.

#### URI jerarquica
Como podemos ver en la realidad una tienda tiene muchos productos, entonces ¿como podemos definir un endpoint para 
un determinado producto de una determinada tienda?, o ¿como podemos listar todos los productos de una determinada 
tienda?.

Estos problemas se pueden resolver de una manera muy facil, solo bastaria pasar los parametros por los cuales 
quires filtrar la consulta directamente en la URI, pero esta solucion no satisface el proposito por el cual 
fue pensada la arquitectura REST, la solucion es muy sencilla y esta en la definicion de la propia URI.

##### 1. Index:  
   Metodo:      GET  
   URI:         /shops/{id_shop}/products  
   Accion:      Listar todos los productos de una determinada tienda  
   
##### 2. Show:  
   Metodo:      GET  
   URI:         /shops/{id_shop}/products/{id}  
   Accion:      Obtener el producto mediante su id, que pertenece a una determinada tienda  
   
##### 3. shop:  
   Metodo:      POST  
   URI:         /shops/{id_shop}/products   
   Accion:      Crear un nuevo producto asociado a una determinada tienda  
   
##### 4. Update:   
   Metodo:      PUT  
   URI:         /shops/{id_shop}/products/{id}    
   Accion:      Actualizar el producto mediante su id, que pertenece a una determinada tienda   
   
##### 5. Delete:  
   Metodo:      DELETE  
   URI:         /shops/{id_shop}/products/{id}  
   Accion:      Eliminar el producto mediante su id
   
NOTA: Puedes utilizar todas las URIS sin la necesidad de verificar la relacion con otros modelos, ejemplo:

##### 1. Index:  
Metodo:      GET  
   URI:         /products  
   Accion:      Listar todos los productos existentes 
  
# Api Gauler
Gauler es una propuesta para desarrollar un sistema simple, capaz de ejecutar operaciones CRUD a determinados modelos, 
mediante la ejecucion de logica escrita en los metodos RestFul establecidos en sus controladores, esta orientando al patron Modelo-Controlador,
no existen vistas ya que se trata de una api RestFul.

# Instalacion

```
composer create-project joalcapa/gauler
```

# Configuracion de Gauler
La configuracion de Gauler se encuentra en el archivo config/config.php

``` php
<?php
// config/config.php
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
    ]
];
```

Gauler utiliza la biblioteca [Dotenv](https://github.com/vlucas/phpdotenv) para definir las variables de entorno necesarias para
el correcto funcionamiento de Gauler, el array anterior esta compuesto por la configuracion necesaria para la conexion 
a la base de datos y la clave secreta para encriptar el token de autorizacion.

Una buena practica es almacenar la informacion secreta en el archivo .env e ignorarlo en el sistema de control de versiones elegido,
puede apreciar la estructura del archivo .env, con el archivo .env.example.

```
# .env.example
DRIVER_DB = 'mysql'
HOST_DB = '127.0.0.1'
PORT_DB = '3306'
USER_DB = 'root'
PASSWORD_DB =
DATABASE_DB = 'gauler'

HOST_API = 'localhost/app/public'
KEY_AUTH = 'my_key_secret'
```

# Que vuelvan los HEROES
Hace ya algunos años cuando comence a documentarme con Angular, me parecio muy peculiar que el equipo de Angular utilizara
el concepto de "heroes" para explicar el funcionamiento de su plataforma, debo aceptar que al igual que a muchos, el cambio de la 
version 1 a la version 2 de Angular fue muy abrumador, despues de todo TypeScript es un superconjunto de javascript que resuelve 
muchos problemas, siendo el mas importante el tipado. Si te gusta Java, TypeScript es para ti.

Los "heroes" llegaron para explicar el funcionamiento de una plataforma que prometia mucho en ese entonces, ahora bien, admitamos que ReactJs
hace las cosas mas simples que Angular y su comunidad ha lanzado potentes herramientas como Redux, siendo Redux una herramienta que no 
depende del framework o biblioteca, es el estandarte de ReactJs, por que si quieres desarrollar en ReactJs o incluso en React-Native, debes saber Redux.

Para este proposito explicare el funcionamiento de Gauler, mediante el concepto de "heroes".

# Vamos a crear el modelo de un heroe
Si vienes trabajando en el lado del back-end, 
habras notado que la mayoria de los frameworks como Laravel, Yii2, Symfony, LoopBack entre otros,
utilizan el patron del modelo para asignar todos los atributos de 
una tabla o coleccion de una base de datos en una clase, cuya instancia sea
una fila o documento de la base de datos.  
  
Gauler utiliza el mismo patron para llevar a cabo la logica de negocios en la base de datos, asi que vamos a crear el modelo "heroes".

Un modelo es una clase que representa una tabla o colleccion de una base de datos, puedes crear una clase con la siguiente estructura en el 
directorio api/models:

``` php
// api/models/HeroesModel.php
<?php

namespace Gauler\Api\Models;

use Joalcapa\Fundamentary\App\Models\BaseModel as Model;

class HeroesModel extends Model {

	public static $model = 'Heroes';

	protected $tuples = [
		'name',
		'powerType',
	];

	protected $hidden_tuples = [
	];
}
```

La clase consta de una propiedad de nombre model, que es el nombre de la tabla a la cual se hace 
referencia, ademas de una propiedad de nombre tuples, que especifica los campos de la tabla y por ultimo 
la propiedad hidden_tuples, la cual es utilizada por Gauler para ocultar los campos de la tabla al 
momento de retornar una instancia del modelo, muy util para ocultar la contraseña de un modelo user.

NOTA: Puedes crear un modelo utilizando la interfaz de linea de comandos de nombre "gaulerium".

### instanciar modelos
Para instanciar un objeto de un modelo y persistir su informacion en la base de datos, se 
realiza de la siguiente manera:

``` php

use Gauler\Api\Models\HeroesModel as Heroes;

$heroe = new Heroes();
$heroe->name = 'Ironman';
$heroe->powerType = 'Conocimiento';
$heroe->save();
```

Como puedes observar el metodo save() realiza la persistencia en la base de datos, inmediatamente el objeto $heroe instanciado
recibe el id de su registro en la base de datos, por lo cual puedes acceder a su propiedad id, justo despues de la llamada
al metodo save().

``` php
$heroe->id;
```

Otra forma de instanciar y persistir el modelo en la base de datos al mismo tiempo, consiste en 
pasar como argumento el objeto request al constructor de la clase.

``` php

use Gauler\Api\Models\HeroesModel as Heroes;

$heroe = new Heroes($request);
$heroe->id;
```

De esta manera se consigue el mismo resultado que el metodo save(), devolviendo el objeto que se 
ha persistido en la base de datos.

### obtener modelos desde la base de datos
Existen diversas formas de obtener modelos directamente de la base de datos

#### 1. Obtener todos los heroes
Con el metodo all(), se obtienen todos los registros de la tabla

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$heroes = Heroes::all();
```

#### 2. Obtener un heroe mediante un id
Con el metodo find($id), se obtiene el registro de la tabla asociado a un id especifico

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$heroe = Heroes::find($id);
```

#### 3. Obtener un conjunto de heroes mediante filtros
Con el metodo where($filters), se obtienen los registros de la tabla que cumplan con un criterio de filtros

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$filters = [
   Heroes::EQUALS('powerType', 'run fast')
];
$heroes = Heroes::where($filters);
```

### Filtros de consulta
Para obtener determinados heroes que cumplen con ciertos parametros, es necesario armar un array que 
contengan dichos parametros de la siguiente manera:

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$filters = [
   Heroes::EQUALS('powerType', 'run fast')
];
$heroes = Heroes::where($filters);
```

Gauler traduce el array $filters a una consulta SQL mediante el metodo "where", en este caso la consulta SQL es la siguiente:

``` sql
WHERE powerType = 'run fast'
```

Como habras notado el metodo 'EQUALS' es el equivalente a la expresion '$attribute = $value', para añadir otro parametro 
de consulta basta con agregarlo al array de la siguiente forma:

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$filters = [
   Heroes::EQUALS('powerType', 'run fast'),
   Heroes::EQUALS('id', $request->id)
];
```

El resultado es la siguiente expresion SQL:

``` sql
WHERE powerType = 'run fast' AND id = 'value of request'
```

Si deseas utilizar un valor alternativo a 'run fast', puedes especificarlo mediante el metodo 'OR', de la siguiente manera:

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$filters = [
   Heroes::EQUALS('powerType', 'run fast'),
   Heroes::OR(
      Heroes::EQUALS('powerType', 'other power'),
      Heroes::EQUALS('id', $request->id)
   )
];
```

El resultado es la siguiente expresion SQL:

``` sql
WHERE powerType = 'run fast' OR ( powerType = 'other power' AND id = 'value of request' )
```

### actualizar un modelo en la base de datos mediante el id
Para actualizar un registro en la base de datos, se requiere el id, pero existen dos formas de hacerlo:

#### 1. metodo update
Este metodo requiere ser llamado desde una instancia donde previamente se ha actualizado en memoria sus atributos
``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$heroe = Heroes::find($request->id);

foreach($heroe->getTuples() as $tuple)
   if(!empty($request->$tuple))
       $heroe->$tuple = $request->$tuple;

$heroe->update();
```

#### 2. metodo updateRequest
Este metodo encapsula el metodo update y retorna la instancia del modelo actualizado
``` php
use Gauler\Api\Models\HeroesModel as Heroes;

$heroe = Heroes::updateRequest($request);
```

### eliminar fisicamente un modelo en la base de datos mediante el id
Para eliminar fisicamente un registro en la base de datos, se requiere el id

``` php
use Gauler\Api\Models\HeroesModel as Heroes;

Heroes::destroy($id);
```

# Rutas del modelo 
Gauler establece un criterio para habilitar el acceso a un determinado modelo, en el 
caso de que desees que el modelo heroes sea alcanzable por el endpoint heroes/ para ejecutar cualquier
operacion CRUD, solo basta con agregarlo al metodo Rest de la siguiente manera:

``` php
// routes/rest.php
<?php

Rest::Model('heroes');

```

De esta manera, al recibir Gauler una solicitud cuya uri este compuesta por el prefijo 
heroes/, se iniciara una busqueda del modelo por medio del metodo Rest, y ejecutara la logica correspondiente,
en caso de no estar declarado el modelo en el metodo Rest, Gauler arrojara el codigo http 404 de recurso no encontrado.

### middleware del modelo
Los middlewares son funciones que deben ejecutarse antes de la ejecucion de la logica del modelo,
en primera instancia Gauler ejecuta el middleware de autenticacion antes de buscar el modelo mediante el metodo Rest,
de esta manera se concede o niega el acceso al modelo en caso de no estar autenticado,
si consideras necesario utilizar otro middleware para un determinado modelo, el metodo Rest recibe como segundo parametro
una funcion anonima, el cual recibe el objeto request de la solicitud.

``` php
// routes/rest.php
<?php

Rest::Model('heroes', function($request) {
  // codigo
  // killer('401');
  return $request;
});

```

Recuerde retornar el objeto request si desea continuar con la ejecucion de la logica del modelo, de lo contrario 
podra utilizar el metodo killer para abortar la operacion con el codigo http que considere conveniente.  

# Controlador del modelo 
Los controladores del modelo se conocen como controladores RestFul, puesto que ejecutan la logica correspondiente
a la operacion CRUD del modelo, para crear un controlador puede hacer uso de "Gaulerium", la interfaz de linea de comandos que Gauler
posee para facilitar este trabajo, la estructura basica de un controlador RestFul asociado al modelo es la siguiente:

``` php
// api/controllers/HeroesController.php
<?php

namespace Gauler\Api\Controllers;

class HeroesController extends Controller {

	public function index($request) {		
	}

	public function show($id) {		
	}
	
	public function shop($request) {		
	}
	
	public function update($id, $request) {		
	}
	
	public function destroy($id) {		
	}
}
```

Puede ver que los metodos corresponden a las operaciones CRUD, Gauler ubica a los controladores en el directorio 
api/controllers/

Una vez declarado el modelo mediante el metodo Rest, Gauler le ofrece la posibilidad de ejecutar un CRUD automatico al no declarar el 
metodo RestFul en el controlador correspondiente al modelo.

### CRUD automatico
Suponga que tiene el modelo HeroesModel y ademas ha habilitado su acceso mediante el metodo Rest, al momento
de crear un nuevo heroe puede verse en alguno de los siguiente casos:

#### 1. No tiene un controlador asignado al modelo en el directorio api/controllers
En este caso Gauler ejecutara la operacion CREATE de manera automatica, verificando la existencia
de los atributos necesarios para crear al nuevo heroe en el cuerpo de la solicitud HTTP.

Los atributos asignados al modelo HeroesModel son, name y powerType.

``` php
// api/models/HeroesModel.php

protected $tuples = [  
  'name',  
  'powerType',
];

```

Mediante la uri heroes/ y teniendo como cuerpo de la solicitud la siguiente estructura:
``` json
{
   "name": "name of new heroe",
   "powerType": "run really fast"
}
```

El resultado de la peticion POST CREATE, sera el siguiente json:
``` json
{
    "message": "OK",
    "data": {
        "id": "1",
        "name": "name of new heroe",
        "powerType": "run really fast"
    }
}
```

De esta manera el heroe de nombre "name of new heroe", ha sido creado e insertado en la tabla heroes 
de la base de datos objetivo, para realizar este ejemplo practico recomiendo el uso de [Postman](https://www.getpostman.com/), herramienta
muy practica para trabajar con apis.

#### 2. No tiene declarado el metodo restFul "store" en su controlador
En este caso, Gauler ejecutara la operacion CREATE de manera automatica al igual que en el caso anterior.

#### 3. Si tiene declarado el metodo restFul "shop" en su controlador
Al contar con el metodo restFul "shop" en el controlador api/controllers/HeroesController.php, Gauler ejecuta este
metodo, note que el metodo "shop" recibe el objeto request con los datos de la solicitud http.

``` php
// api/controllers/HeroesController.php

public function shop($request) {	
  $heroe = new Heroe($request);
  return $heroe;
}

```

# Autenticacion
Gauler se reserva el mecanismo de autenticacion de usuario, para efectos de demostracion considere el usuario con datos falsos que se encuentra en 
el archivo UsersSeeder.php alojado en el directorio seeders/

``` php
// seeders/UsersSeeder.php
<?php

namespace Gauler\Seeders;

use Gauler\api\models\UsersModel as Users;

class UsersSeeder {

    public function boom() {
        $user = new Users();
        $user->name = 'admin';
        $user->email = 'admin@admin.com';
        $user->password = hashBCrypt('123456789Password');
        $user->save();
    }
}
```

Mediante el comando

```
php gaulerium seeder UsersSeeder
```

Podra facilmente sembrar los datos del nuevo usuario en la base de datos, obviando que de antemano existe la tabla users en la
 base de datos objetivo, de lo contrario haga la respectiva migracion del modelo users a la base de datos.  
 
Gauler ha reservado
la URL /api/auth para realizar la autenticacion de usuario, el endpoint /auth requiere la siguiente informacion:

``` json
// Metodo POST
// Body en json
{
	"email": "admin@admin.com",
	"password": "123456789Password"
}
``` 

Dara como respuesta el siguiente JSON:

``` json
{
    "message": "OK",
    "data": {
        "user": {
            "name": "admin",
            "email": "admin@admin.com"
        },
        "token": "eyJ0eXAiOiJKV1QiLCJhbGci..."
    }
}
``` 

Como puede observar Gauler retorna el token de autorizacion con el cual podra consumir todos los endpoints de la api
estableciendo la cabecera de Authorization de la siguiente manera:

``` 
Authorization: Bearer $token
``` 

## Cambiar contraseña
Gauler ha reservado la URL /api/auth/reset-password para el mecanismo de cambio de contraseña por el metodo POST, 
generando de esa manera un nuevo token de acceso.

``` json
// Metodo POST
// Body en json
{
	"email": "admin@admin.com",
	"password": "123456789Password",
	"newPassword": "newPassword"
}
``` 

Dara como respuesta el siguiente JSON:

``` json
{
    "message": "OK",
    "data": {
        "user": {
            "name": "admin",
            "email": "admin@admin.com"
        },
        "token": "eyJ0reWeXAiOiJKV1QiLCJhbGciOi..."
    }
}
```   

# Gaulerium CLI
Gaulerium es una interfaz de linea de comandos capaz de crear modelos, controladores,
migraciones, entre otras cosas.

## crear modelo
Siendo Gauler una api REST, el modelo debe tener concordancia con el endpoint objetivo, ejemplo: para el 
uri: /heroes/{id} el modelo asociado es: HeroesModel, 
para crear un modelo, gaulerium necesita el nombre del modelo, de manera opcional
puedes especificar los atributos del modelo.
```
php gaulerium createModel heroe [attr:TypeAttrQ::TYPE,....,attr:TypeAttrQ::TYPE]
```

El resultado es la creacion de una nueva clase en el directorio api/models del proyecto.

``` php
// api/models/HeroesModel.php
<?php

namespace Gauler\Api\Models;

use Joalcapa\Fundamentary\App\Models\BaseModel as Model;

class HeroesModel extends Model {

	public static $model = 'Heroes';

	protected $tuples = [
		'name',
		'powerType',
	];

	protected $hidden_tuples = [
	];
}
```

El comando createModel recibe el nombre del modelo en singular, estableciendo la creacion del modelo
en plural como (nombre en singular)sModel, el nombre de la tabla asociada al modelo tambien debe estar en plural,
si deseas eliminar esta convencion, puedes especificar directamente en el modelo, el nombre de la tabla a la 
cual el modelo apunta.

#### TypeAttrQ
Gauler establece diferentes tipos de datos para los atributos de un modelo mediante la clase [TypeAttrQ](https://github.com/joalcapa/Elementary/blob/master/src/Generics/TypeAttrQ.php), entre los mas
utilizados tenemos:

``` php
TypeAttrQ::STRING;   // string
TypeAttrQ::INTEGER;  // integer
TypeAttrQ::DOUBLE;   // double
TypeAttrQ::BOOLEAN;  // boolean
TypeAttrQ::FLOAT;    // float
```

#### creacion del modelo con su migracion
Si el modelo se crea con sus atributos, Gauler creara el correspondiente archivo de migracion asociado al modelo. 
       
## crear controlador
Por defecto Gauler ejecuta un proceso CRUD automatico cuando no existe un controlador asociado al modelo, 
en caso de que desees añadir logica en algun proceso de operacion CRUD, puedes optar por la creacion de un 
controlador, podras sobreescribir el metodo Rest que desees,
para crear un controlador, gaulerium necesita el nombre del controlador asociado al modelo.
```
php gaulerium createController heroe
```

El resultado es la creacion de una nueva clase en el directorio api/controllers del proyecto.

``` php
// api/controllers/HeroesController.php
<?php

namespace Gauler\Api\Controllers;

class HeroesController extends Controller {

	/**
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function index($request) {
	}


	/**
	* @param  $id
	* @return  array
	*/
	public function show($id) {		
	}


	/**
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function shop($request) {		
	}


	/**
	* @param  $id
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function update($id, $request) {		
	}


	/**
	* @param  $id
	* @return  array
	*/
	public function destroy($id) {		
	}
}
```

Para que la busqueda del controlador asociado al modelo sea exitosa, el controlador debe tener concordancia con el nombre del modelo,
ejemplo: para el modelo: HeroesModel, el controlador asociado es: HeroesController

## crear migracion
Para crear un archivo de migracion asociado a un modelo, gaulerium necesita el nombre del modelo, de manera opcional
puedes especificar los atributos del modelo.
```
php gaulerium createMigration heroe [attr:TypeAttrQ::TYPE,....,attr:TypeAttrQ::TYPE]
```

El resultado es la creacion de una nueva clase en el directorio database/migrations del proyecto, notaras
que en el nombre del archivo se antepone la fecha en la cual fue creada la migracion en el formato TimesTamp, esto es necesarios para que
Gauler tenga un control de las migraciones realizadas.

```
1550349238HeroesMigration.php
```

``` php
// database/migrations/1550349238HeroesMigration.php
<?php

namespace Gauler\Database\Migrations;

use Joalcapa\Elementary\Generics\TypeAttrQ as TypeAttrQ;
use Joalcapa\Elementary\Migrations\BaseMigration as Migration;

class HeroesMigration extends Migration {

	public $attributes = [
		'name' => TypeAttrQ::STRING,
		'power' => TypeAttrQ::STRING,
	];
}
```

## migrar a la base de datos
Si deseas migrar a la base de datos bastara con ejecutar el siguiente comando,
de esta forma Gauler ejecutara las migraciones almacenadas, de manera opcional puedes realizar la
migracion de un solo modelo en la base de datos.

```
php gaulerium migrate [nameModel]
```

## Seeders
Gaulerium ofrece un mecanismo para sembrar datos falsos en la base de datos objetivo, puedes 
crear un nuevo archivo seeder mediante el siguiente comando:

```
php gaulerium createSeeder heroe
```

El resultado es una nueva clase seeder en el directorio seeders/

``` php
// seeders/HeroesSeeder.php
<?php

namespace Gauler\Seeders;

class HeroesSeeder {

    public function boom() {
    }
}
```

La clase seeder resultante posee un solo metodo (boom) con el cual puedes instanciar los modelos con informacion falsa 
que desees, para posteriormente sembrarlos en la base de datos mediante el siguiente comando:

```
php gaulerium seeder [nameSeeder]
```

Al igual que el comando migrate, este comando puede ejecutar un solo seeder si lo desea, pasando como argumento el nombre.