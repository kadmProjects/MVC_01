<?php
namespace App\resources\packages\routes;

use App\resources\packages\routes\RouteRegister;

class Route {

    private static $_instance;
    private $currentRoute;
    protected $_get_routes = [];
    protected $_post_routes = [];
    protected $_put_routes = [];
    protected $_patch_routes = [];
    protected $_delete_routes = [];
    private $allowedRoutes = [
        'get', 'post', 'put', 'patch', 'delete'
    ];

    public function __construct() {}

    public static function __callStatic(String $name, Array $arguments) {
        return self::selfInstance()->registerRoutes($name, $arguments);
    }

    private static function selfInstance() {
        if ( ! isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    private function registerRoutes(String $name, Array $arguments) {
        $name = strtolower($name);
        if (in_array($name, $this->allowedRoutes)) {
            return $this->register($name, $arguments);
        } else {
            //TO DO
            var_dump('Undefined route method name exception');
            return $this;
        }
    }

    private function register(String $name, Array $arguments) {
        $route = $this->purifyRoute($arguments);

        return $this->registerEachRoute(new RouteRegister(), $name, $route, $arguments);
    }

    private function splitToClassAndAction(Array $arguments) {
        $arguments = explode('@', $arguments[1]);
        return $arguments;
    }

    private function purifyRoute(Array $arguments) {
        return trim($arguments[0], '/');
    }

    protected function addToArray(String $route, String $method, Array $arguments): Array {        
        $endPoint = $this->splitToClassAndAction($arguments);
        $route = [
            'uri' => $route,
            'method' => $method,
            'target' => $arguments[1],
            'controller' => $endPoint[0],
            'action' => $endPoint[1],
            'name' => ''
        ];

        return $route;
    }

    private function registerEachRoute(RouteRegister $routeRegister, String $name, String $route, Array $endPoint) {
        $this->currentRoute = $name;
        $routeRegister->{$name}($route, $endPoint);
        return $this;
    }

    protected function getAllRoutes($method) {
        //return $this->_{$method} _routes;
    }

    public function name($name) {
        //var_dump($this->currentRoute);
    }

    // public static function isValidRoute($url) {
    //     $inArray = array_search(filter_var($url, FILTER_SANITIZE_URL), self::$getRoutesList);
    //     if ($inArray !== false) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

}