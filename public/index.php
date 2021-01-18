<?php

use App\Router\Routes;
use Config\Config;

require __DIR__.'./../vendor/autoload.php';

$config = new Config();
$config->initSessionId();

$routes = new Routes();
$routes->routesIndex();

/**
 * @param $name
 * @return string
 */
function url($name)
{
    global $routes;
    return $routes->findNameRoute($name)->getPath();
}
