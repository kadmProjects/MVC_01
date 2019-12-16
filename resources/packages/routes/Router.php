<?php
namespace App\resources\packages\routes;

class Router extends Route {
    public function __construct() {

    }

    public static function content($url, $action) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // if ($_SERVER['REQUEST_URI']) {
                Route::addToGetCollection($url);
            //var_dump();
            if (Route::isValidRoute($_SERVER['REQUEST_URI'])) {
                $action = explode('@', $action);
                //TODO - Get namespace of the given class.
                $qualifiedClass = BASE_NAMESPACE . $action[0];
                if (class_exists($qualifiedClass)) {
                    //TODO - Need to be flexible to pass the parameters with the route
                    $class = new $qualifiedClass;
                    $method = $action[1];
                    if (method_exists($class, $method)) {
                        $callback_arr = array($class, $method);
                        if (is_callable($callback_arr) === true) {
                            return call_user_func_array($callback_arr, []);
                        } else {
                            var_dump('Not callable');
                            //return;
                        }
                    } else {
                        var_dump('Class method not defined');
                        //return;
                    }
                } else {
                    var_dump("Class $action[0] not defined");
                    //return;
                }
            } else {
                var_dump("Invalid Route");
                //return;
            }
        } else {
            var_dump("You cannot use this method for your REQUEST. Your REQUEST is a " . $_SERVER["REQUEST_METHOD"] . ' REQUEST. Please use a suitable REQUEST method.');
            //return;
        }
    }
}