<?php

namespace Gauler\Database\Migrations;

use Joalcapa\Origins\App\Migrations\BaseMigration as Migration;
use Joalcapa\Origins\App\DataBase\Types\DBTypes as DBTypes;

class UserMigration extends Migration {

	public $attributes = [
		'name' => DBTypes::string,
		'email' => DBTypes::string,
		'password' => DBTypes::string
	];

	public $dependencias = [

	];
}
