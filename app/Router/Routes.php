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
            new Route('GET', 'editPost', '/editPost/create', [BlogListController::class, 'form']),
            new Route('GET', 'viewPost', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('GET', 'register', '/register', [MembreController::class, 'membresSubscribe']),
            new Route('GET', 'login', '/login', [MembreController::class, 'membresConnexion']),
            new Route('GET', 'logout', '/logout', [MembreController::class, 'logout']),
            new Route('GET', 'postFormById', '/{id}', [BlogListController::class, 'postFormById']),
            new Route('POST', 'addComment', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('POST', 'sendMail', '/sendMail', [ContactSendMail::class, 'sendMail']),
            new Route('POST', 'addPost', '/addPost', [BlogListController::class, 'addPost']),
            new Route('POST', 'addRegister', '/register', [MembreController::class, 'inscription']),
            new Route('POST', 'loginVerif', '/loginVerif', [MembreController::class, 'login']),
            new Route('POST', 'updatePost', '/updatePost', [BlogListController::class, 'updatePostById']),
        ];

        foreach ($routes as $route) {
            $router->add($route);
        }

        $match = $router->match($methode, "/$url");
        if (!$match) {
            return $config->render("layout.php", "error404.php", array());
        }

        return $router->call($methode, "/$url");
    }
}
