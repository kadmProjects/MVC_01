<?php
namespace App\resources\packages\routes;

use App\resources\packages\routes\RouteRegister;

class Route {

    private static $_instance;
    private $current_route;
    protected $_get_routes = [];
    protected $_post_routes = [];
    protected $_put_routes = [];
    protected $_patch_routes = [];
    protected $_delete_routes = [];
    protected $_named_routes = [];
    private $allowed_routes = [
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
        if (in_array($name, $this->allowed_routes)) {
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
        $routeDataArray = $routeRegister->{$name}($route, $endPoint);
        $this->current_route = $name;
        $this->addToRouteList($name, $routeDataArray);

        return $this;
    }

    private function addToRouteList(String $name, Array $routeData) {
        array_push($this->{'_' . $name . '_routes'}, $routeData);
    }

    public function name($name) {
        $currentRoute = $this->current_route;
        $lastElement = end($this->{'_' . $currentRoute . '_routes'});
        $lastElement['name'] = $name;
        array_push($this->_named_routes, $lastElement);
    }

    public function getArray() {
        var_dump($this->current_route);
    }
}