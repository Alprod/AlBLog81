<?php

use App\Controller\BlogListController;
use App\Router\Router;
use App\Router\Route;
use App\Controller\HomeController;
use Config\Config;

require 'vendor/autoload.php';
$config = new Config();
$url = $_REQUEST['url'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$route = new Route('GET','Home', '/', [HomeController::class, "index"]);

$router->add($route);

echo $router->call($method,"/$url");

