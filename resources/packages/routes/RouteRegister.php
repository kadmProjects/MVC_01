<?php
namespace App\resources\packages\routes;

class RouteRegister extends Route {

   public function __construct() {}
   
   /**
    * Register all the GET routes
    *
    * @param String $route
    * @param Array $endPoint
    * @return void
    */
   public function get(String $route, Array $arguments) {
      $method = 'GET';
      $getRoutesArray = &$this->_get_routes;
      $route = $this->addToArray($route, $method, $arguments);
      array_push($getRoutesArray, $route);
   }

   /**
    * Register all the POST routes
    *
    * @param String $route
    * @param Array $endPoint
    * @return void
    */
   public function post(String $route, Array $endPoint) {
      //var_dump($route, $endPoint);
   }

}