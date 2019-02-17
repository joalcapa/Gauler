# Gauler
Api standar RestFull by Jose Caceres

## Hablemos un poco de las apis RestFull
Existen diversos servicios web como lo son SOAP, GraphQL entre otros.
Pero REST es el servicio web popular por excelencia, muchos sistemas y frameworks trabajan bajo esta arquitectura, aproximadamente en el 
año 2000, Roy Fielding propone este nuevo servicio web.

Las caracteristicas son muchas y existen muchos foros y blogs donde se habla al respecto, la primera fuente a consultar 
es la misma de Roy Fielding, en su [trabajo](https://www.ics.uci.edu/~fielding/pubs/dissertation/top.htm) acerca de Rest,
algo mas ligero y rapido lo puedes encontrar en el siguiente [articulo](http://asiermarques.com/2013/conceptos-sobre-apis-rest/), en este articulo
Asier Marqués describe todas las caracteristicas escenciales para una arquitectura REST.

#### Metodos RestFull
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
   
##### 3. Store:  
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
  
## Que es Gauler?
Gauler es una propuesta para desarrollar un sistema simple, capaz de ejecutar operaciones CRUD a determinados modelos, 
mediante la ejecucion de logica escrita en los metodos RestFull establecidos en sus controladores, esta orientando al patron Modelo-Controlador,
no existen vistas ya que se trata de una api RestFull.

### Creando proyecto Gauler

```
composer create-project joalcapa/gauler
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

# Rutas del modelo 
Gauler establece un criterio para habilitar o no el acceso a un determinado modelo, en el 
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
en primera instancia, Gauler ejecuta el middleware de autenticacion antes de buscar el modelo mediante el metodo Rest,
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
Los controladores del modelo se conocen como controladores RestFull, puesto que ejecutan la logica correspondiente
a la operacion CRUD del modelo, para crear un controlador puede hacer uso de "Gaulerium", la interfaz de linea de comandos que Gauler
posee para facilitar este trabajo, la estructura basica de un controlador RestFull asociado al modelo es la siguiente:

``` php
// api/controllers/HeroesController.php
<?php

namespace Gauler\Api\Controllers;

class HeroesController extends Controller {

	public function index($request) {		
	}

	public function show($id) {		
	}
	
	public function store($request) {		
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
metodo RestFull en el controlador correspondiente al modelo.

### creando un nuevo heroe
Suponga que tiene el modelo HeroesModel y ademas ha habilitado su acceso mediante el metodo Rest, al momento
de crear un nuevo heroe puede verse en alguno de los siguiente casos:

#### 1. No tiene un controlador asignado al modelo en el directorio api/controllers
En este caso Gauler ejecutara la operacion CREATE de manera automatica, verificando la existencia
de los atributos necesarios para crear al nuevo heroe en el cuerpo de la solicitud HTTP.

Los atributos asignados al modelo HeroesModel son, name y powerType.

``` php
// api/models/HeroesModel.php
.....
protected $tuples = [
		'name',
		'powerType',
	];
.....
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

#### 2. No tiene declarado el metodo restFull "store" en su controlador
En este caso, Gauler ejecutara la operacion CREATE de manera automatica al igual que en el caso anterior.

#### 3. Si tiene declarado el metodo restFull "store" en su controlador
Al contar con el metodo restFull "store" en el controlador api/controllers/HeroesController.php, Gauler ejecuta este
metodo, note que el metodo "store" recibe el objeto request con los datos de la solicitud http.

``` php
// api/controllers/HeroesController.php
.....
public function store($request) {		
  // code
}
.....
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
TypeAttrQ::STRING;
TypeAttrQ::INTEGER;
TypeAttrQ::DOUBLE;
TypeAttrQ::BOOLEAN;
TypeAttrQ::FLOAT;
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
	public function store($request) {		
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