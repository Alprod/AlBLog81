<?php

use App\Controller\BlogListController;
use App\Controller\HomeController;
use App\Router\Route;
use App\Router\Router;

require __DIR__ . './../vendor/autoload.php';

$url = $_REQUEST['url'] ?? null;
$uri = $_SERVER['REQUEST_URI'];
$methode = $_SERVER['REQUEST_METHOD'];

$router = new Router();

$routes = array(
    new Route('GET', 'home', '/', [HomeController::class, 'index']),
    new Route('GET', 'blogList', '/blogs', [BlogListController::class, 'blogList'])
);


$explode = explode('/', $uri);
array_shift($explode);


foreach ($routes as $route) {
    $router->add($route);
}

$router->call($methode, "/$url");

