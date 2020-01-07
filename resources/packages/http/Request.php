<?php

namespace App\resources\packages\http;

class Request {
    private $_server = [];

    public function __construct() {
        $this->_server = $_SERVER;
    }

    public function _method() {
        $requestMethod = $this->_server['REQUEST_METHOD'];
        $requestMethod = strtolower($requestMethod);

        return $requestMethod;
    }

    public function _uri() {
        $requestUri = $this->_server['REQUEST_URI'];
        $requestUri = filter_var($this->purifyUri($requestUri), FILTER_SANITIZE_URL);

        return $requestUri;
    }

    private function purifyUri($uri) {
        return trim($uri, '/');
    }
}