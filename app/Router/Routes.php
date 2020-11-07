<?php


namespace App\Router;

use App\Controller\BlogListController;
use App\Controller\ContactSendMail;
use App\Controller\HomeController;
use App\Controller\MembreController;
use Config\Config;

class Routes
{
    public function routesIndex()
    {
        $url = $_REQUEST['url'] ?? null;
        $uri = $_SERVER['REQUEST_URI'];
        $methode = $_SERVER['REQUEST_METHOD'];

        $router = new Router();
        $config = new Config();

        $routes = [
            new Route('GET', 'home', '/', [HomeController::class, 'index']),
            new Route('GET', 'blogs', '/blogs', [BlogListController::class, 'blogList']),
            new Route('GET', 'contact', '/contact', [ContactSendMail::class, 'contact']),
            new Route('GET', 'viewPost', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('GET', 'register', '/register', [MembreController::class, 'membresSubscribe']),
            new Route('POST', 'sendMail', '/sendMail', [ContactSendMail::class, 'sendMail']),
            new Route('POST', 'addComment', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('POST', 'addRegister', '/addRegister', [MembreController::class, 'inscription'])
        ];

        foreach ($routes as $route) {
            $router->add($route);
        }

        $match = $router->match($methode, "/$url");
        if(!$match){
            return $config->render("layout.php","error404.php", array());
        }

        return $router->call($methode, "/$url");
    }

}