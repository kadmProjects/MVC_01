<?php

use App\resources\packages\routes\Router;
use App\resources\packages\http\Request;

require_once '../autoload.php';

$router = new Router(new Request());

require_once '../config/routes.php';

return $router;