# Gauler
Api standar Rest --

### Creando proyecto Gauler

```
composer create-project joalcapa/gauler
```

## Gaulerium CLI
Gaulerium es una interfaz de linea de comandos capaz de crear modelos, controladores,
migraciones, entre otras cosas

### crear modelo
Para crear un modelo, gaulerium necesita el nombre del modelo, de manera opcional
puedes especificar los atributos del modelo
```
php gaulerium createModel heroe [attr:type,....,attr:type]
```

El resultado es la creacion de una nueva clase en el directorio api/models del proyecto

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

### crear controlador
Para crear un modelo, gaulerium necesita el nombre del controlador asociado al modelo
```
php gaulerium createController heroe
```

El resultado es la creacion de una nueva clase en el directorio api/controllers del proyecto

``` php
<?php

namespace Gauler\Api\Controllers;

class HeroesController extends Controller {

	/**
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function index($request) {		}


	/**
	* @param  $id
	* @return  array
	*/
	public function show($id) {		}


	/**
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function store($request) {		}


	/**
	* @param  $id
	* @param  \Fundamentary\Http\Interactions\Request\Request  $request
	* @return  array
	*/
	public function update($id, $request) {		}


	/**
	* @param  $id
	* @return  array
	*/
	public function destroy($id) {		}
}
```