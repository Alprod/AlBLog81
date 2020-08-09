<?php
use App\Router\Router;
use App\Router\Route;
use App\Controller\HomeController;
require 'vendor/autoload.php';
$url = $_REQUEST['url'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router();
$route = new Route('GET','home', '/', [HomeController::class, "index"]);
$router->add($route);

echo $router->call($method,"/$url");
