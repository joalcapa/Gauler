<?php

/**
 * Gauler - Api REST PHP
 *
 * @package  Gauler
 * @author   José Cáceres <josecaceres.oreul@gmail.com>
 * @web      https://www.joalcapa.com.ve
 */

require_once __DIR__.'/../bootstrap/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

$app->init();

$app->sendResponse();