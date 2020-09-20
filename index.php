<?php
require_once __DIR__.'/vendor/autoload.php';

use App\Controller\HomeController;
use App\Router\Route;
use App\Router\Router;


$url = $_REQUEST['url']??null;


$methode = $_SERVER['REQUEST_METHOD'];
$router = new Router();

$route = new Route('GET','home','/',[HomeController::class, 'index']);

$router->add($route);

$router->call($methode, "/");

