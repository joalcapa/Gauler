# Gauler
Api standar Rest --

### Creando proyecto Gauler

```
composer create-project joalcapa/gauler
```

## Gaulerium CLI
Gaulerium es una interfaz de linea de comandos capaz de crear modelos, controladores,
migraciones, entre otras cosas.

### crear modelo
Siendo Gauler una api REST, el modelo debe tener concordancia con el endpoint objetivo, ejemplo: para el 
uri: /heroes/{id} el modelo asociado es: HeroesModel, 
para crear un modelo, gaulerium necesita el nombre del modelo, de manera opcional
puedes especificar los atributos del modelo.
```
php gaulerium createModel heroe [attr:TypeAttrQ,....,attr:TypeAttrQ]
```

El resultado es la creacion de una nueva clase en el directorio api/models del proyecto.

``` php
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
TypeAttrQ.STRING;
TypeAttrQ.INTEGER;
TypeAttrQ.DOUBLE;
TypeAttrQ.CHAR;
TypeAttrQ.BOOLEAN;
TypeAttrQ.FLOAT;
```

### crear controlador
Por defecto Gauler ejecuta un proceso CRUD automatico cuando no existe un controlador asociado al modelo, 
en caso de que desees añadir logica en algun proceso de operacion CRUD, puedes optar por la creacion de un 
controlador, podras sobreescribir el metodo Rest que desees,
para crear un controlador, gaulerium necesita el nombre del controlador asociado al modelo.
```
php gaulerium createController heroe
```

El resultado es la creacion de una nueva clase en el directorio api/controllers del proyecto.

``` php
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