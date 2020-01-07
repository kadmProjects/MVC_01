<?php
namespace App\resources\packages\routes;

/**
 * Register each routes
 */
class RouteRegister extends Route {

    public function __construct() {}
   
    /**
        * Register all the GET routes
        *
        * @param String $route
        * @param Array $arguments
        * @return void
        */
    public function get(String $route, Array $arguments) {
        $method = 'GET';
        $routeArray = $this->addToArray($route, $method, $arguments);

        return $routeArray;
    }

    /**
        * Register all the POST routes
        *
        * @param String $route
        * @param Array $arguments
        * @return void
        */
    public function post(String $route, Array $arguments) {
        $method = 'POST';
        $routeArray = $this->addToArray($route, $method, $arguments);

        return $routeArray;
    }

    /**
        * Register all the PUT routes
        *
        * @param String $route
        * @param Array $arguments
        * @return void
        */
    public function put(String $route, Array $arguments) {
        $method = 'PUT';
        $routeArray = $this->addToArray($route, $method, $arguments);

        return $routeArray;
    }

    /**
        * Register all the PATCH routes
        *
        * @param String $route
        * @param Array $arguments
        * @return void
        */
    public function patch(String $route, Array $arguments) {
        $method = 'PATCH';
        $routeArray = $this->addToArray($route, $method, $arguments);

        return $routeArray;
    }

    /**
        * Register all the DELETE routes
        *
        * @param String $route
        * @param Array $arguments
        * @return void
        */
    public function delete(String $route, Array $arguments) {
        $method = 'DELETE';
        $routeArray = $this->addToArray($route, $method, $arguments);

        return $routeArray;
    }

}