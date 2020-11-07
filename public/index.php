<?php

use App\Router\Routes;
use Config\Config;

$config->initSessionId();

require __DIR__.'./../vendor/autoload.php';

$routes = new Routes();
$config = new Config();
$routes->routesIndex();

