<?php

use App\Controller\BlogListController;
use App\Controller\HomeController;
use App\Router\Route;
use App\Router\Router;

require __DIR__.'./../vendor/autoload.php';

$url = $_REQUEST['url'] ?? null;
$uri = $_SERVER['REQUEST_URI'];
$methode = $_SERVER['REQUEST_METHOD'];

$router = new Router();

$routes = [
    new Route('GET', 'home', '/home', [HomeController::class, 'index']),
    new Route('GET', 'blogs', '/blogs', [BlogListController::class, 'blogList']),
];

foreach ($routes as $route) {
    $router->add($route);
}

$router->call($methode, "/$url");
