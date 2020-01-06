<?php

namespace App\resources\packages\http;

class Request {
    private $_server = [];

    public function __construct() {
        $this->_server = $_SERVER;
    }

    public function method() {
        $requestMethod = $this->_server['REQUEST_METHOD'];
        $requestMethod = strtolower($requestMethod);

        return $requestMethod;
    }
}