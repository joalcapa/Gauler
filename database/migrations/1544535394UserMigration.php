<?php

namespace Gauler\Database\Migrations;

use Joalcapa\Elementary\Generics\TypeAttrQ as TypeAttrQ;
use Joalcapa\Elementary\Migrations\BaseMigration as Migration;

class UserMigration extends Migration {

	public $attributes = [
	     'name' => TypeAttrQ::STRING,
	     'email' => TypeAttrQ::STRING,
	     'password' => TypeAttrQ::STRING
	];
}
