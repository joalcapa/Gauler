<?php

namespace Gauler\Database\Migrations;

use Joalcapa\Elementary\Generics\TypeAttrQ as TypeAttrQ;
use Joalcapa\Elementary\Migrations\BaseMigration as Migration;

class UserMigration extends Migration {

	public $attributes = [
	     'name' => TypeAttrQ::string,
	     'email' => TypeAttrQ::string,
	     'password' => TypeAttrQ::string
	];
}
