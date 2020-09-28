<?php


namespace App\Router;

use App\Controller\BlogListController;
use App\Controller\HomeController;

class Routes
{
    public function routesIndex()
    {
        $url = $_REQUEST['url'] ?? null;
        $uri = $_SERVER['REQUEST_URI'];
        $methode = $_SERVER['REQUEST_METHOD'];

        $router = new Router();

        $routes = [
            new Route('GET', 'home', '/home', [HomeController::class, 'index']),
            new Route('GET', 'blogs', '/blogs', [BlogListController::class, 'blogList']),
            new Route('GET', 'viewPost', '/viewPost/{slug}/{id}', [BlogListController::class, 'blogPost']),
        ];

        foreach ($routes as $route) {
            $router->add($route);
        }

        return $router->call($methode, "/$url");

    }

}