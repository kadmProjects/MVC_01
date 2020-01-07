<?php
namespace App\resources\packages\routes;

use App\resources\packages\http\Request;

class Router {

    private $request;
    private $_current_route = [];
    public $_get_routes = [];
    public $_post_routes = [];
    public $_put_routes = [];
    public $_patch_routes = [];
    public $_delete_routes = [];
    public $_named_routes = [];
    public $_named_routes_associate = [];

    public function __construct(Request $request) {
        $this->request = $request;
    }

    private function _actionCall($controllerName, $actionName) {
        if (class_exists($controllerName)) {
            $class = new $controllerName;
            if (method_exists($class, $actionName)) {
                $callback_arr = array($class, $actionName);
                if (is_callable($callback_arr) === true) {
                    return call_user_func_array($callback_arr, []);
                } else {
                    var_dump('Not callable');
                }
            } else {
                var_dump('Class method not defined');
            }
        } else {
            var_dump("Class $controllerName not defined");
        }
    }

    private function execute() {
        $currentRoute = $this->getCurrentRoute();

        if (!empty($currentRoute)) {
            $controllerName = CONTROLLER_NAMESPACE . $currentRoute['controller'];
            $actionName = $currentRoute['action'];
            $this->_actionCall($controllerName, $actionName);
        } else {
            var_dump('Current route is empty');
        }
    }

    private function routeExecute() {
        $method = $this->request->_method();
        $uri = $this->request->_uri();

        if ($uri !== false) {
            if ($this->isValidRoute($uri, $method)) {
                $this->execute();
            } else {
                var_dump("Invalid Route");
            }
        } else {
            var_dump('uri filtering failed in request');
        }
    }

    public function run() {
        $this->routeExecute();
    }

    private function isValidRoute($uri, $method) {
        $routeList = $this->{ $method . 'Routes'}();
        $count = count($routeList);

        for ($i = 0; $i < $count; $i++) {
            if (array_key_exists('uri', $routeList[$i])) {
                $route = $routeList[$i];
                if ($route['uri'] === $uri) {
                    $this->setCurrentRoute($route);
                    return true;
                }
            }
        }
    }

    private function setCurrentRoute(Array $route) {
        $this->_current_route = $route;
    }

    private function getCurrentRoute() {
        return $this->_current_route;
    }

    private function getRoutes() {
        return $this->_get_routes;
    }

    private function postRoutes() {
        return $this->_post_routes;
    }

    private function putRoutes() {
        return $this->_put_routes;
    }

    private function patchRoutes() {
        return $this->_patch_routes;
    }

    private function deleteRoutes() {
        return $this->_delete_routes;
    }
}