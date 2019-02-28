<?php

namespace Gauler\Api\Controllers;

class ApiController {

    public function hello($request) {
        return [
            'message' => 'hello'
        ];
    }
}