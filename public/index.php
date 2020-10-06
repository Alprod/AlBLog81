<?php

use App\Model\PostsModel;
use App\Router\Router;
use App\Router\Routes;
use Config\Config;

require __DIR__.'./../vendor/autoload.php';

function assets($url): string
{
    return "http://localhost/AlBlog81/".$url;
}


$routes = new Routes();

$routes->routesIndex();

