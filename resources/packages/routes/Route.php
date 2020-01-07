<?php
namespace App\resources\packages\routes;

use App\resources\packages\routes\RouteRegister;
use App\resources\packages\routes\Router;
use App\resources\packages\http\Request;

class Route {

    private static $_instance;
    public $_router;
    private $current_route;
    private $allowed_routes = [
        'get', 'post', 'put', 'patch', 'delete'
    ];

    public function __construct() {}

    private static function selfInstance() {
        if ( ! isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    public static function __callStatic(String $name, Array $arguments) {
        return self::selfInstance()->registerRoutes($name, $arguments);
    }

    public static function router() {
        return self::selfInstance()->getRouter();
    }

    private function getRouter() {
        return $this->routerInstance(new Router(new Request));
    }

    private function routerInstance(Router $router) {
        if ( ! isset($this->_router)) {
            $this->_router = $router;
        }

        return $this->_router;
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
        array_push($this->getRouter()->{'_' . $name . '_routes'}, $routeData);
    }

    public function name($name) {
        $currentRoute = $this->current_route;
        $lastElement = end($this->getRouter()->{'_' . $currentRoute . '_routes'});
        $lastElement['name'] = $name;
        $this->getRouter()->_named_routes_associate[$name] = $lastElement;
        array_push($this->getRouter()->_named_routes, $lastElement);
    }
}