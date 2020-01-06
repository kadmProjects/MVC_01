<?php

use App\resources\packages\routes\Route;
use App\resources\packages\routes\Router;
use App\resources\packages\http\Request;

$router = new Router(new Request());

require_once '../autoload.php';
require_once '../config/routes.php';

Route::routeRun($router);