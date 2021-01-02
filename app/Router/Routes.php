<?php


namespace App\Router;

use App\Controller\AdminController;
use App\Controller\BlogListController;
use App\Controller\ContactSendMail;
use App\Controller\HomeController;
use App\Controller\MembreController;
use Config\Config;

class Routes
{
    /**
     * @var
     */
    public $routes;
    /**
     * @var mixed|null
     */
    private $url;
    private $uri;
    private $methode;
    /**
     * @var Router
     */
    private Router $router;


    public function __construct()
    {
        $this->url = $_REQUEST['url'] ?? null;
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->methode = $_SERVER['REQUEST_METHOD'];
        $this->router = new Router();
    }

    /**
     * @return bool|mixed
     * @throws RouteAlreadyExistExecption
     * @throws \ReflectionException
     */
    public function routesIndex()
    {

        $config = new Config();

        $this->routes = [
            new Route('GET', 'home', '/', [HomeController::class, 'index']),
            new Route('GET', 'blogs', '/blogs', [BlogListController::class, 'blogList']),
            new Route('GET', 'contact', '/contact', [ContactSendMail::class, 'contact']),
            new Route('GET', 'editPost', '/editPost/create', [BlogListController::class, 'form']),
            new Route('GET', 'postFormById', '/posts/{id}', [BlogListController::class, 'postFormById']),
            new Route('GET', 'viewPost', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('GET', 'register', '/formRegister', [MembreController::class, 'membresSubscribe']),
            new Route('GET', 'updateRegister', '/updateRegister', [MembreController::class, 'updateRegister']),
            new Route('GET', 'login', '/login', [MembreController::class, 'membresConnexion']),
            new Route('GET', 'logout', '/logout', [MembreController::class, 'logout']),
            new Route('GET', 'profil', '/profil', [MembreController::class, 'userProfil']),
            new Route('GET', 'dashbaord', '/dashbaord', [AdminController::class, 'dashbaordAdmin']),
            new Route('POST', 'addComment', '/{slug}/{id}', [BlogListController::class, 'blogPost']),
            new Route('POST', 'sendMail', '/sendMail', [ContactSendMail::class, 'sendMail']),
            new Route('POST', 'addPost', '/addPost', [BlogListController::class, 'addPost']),
            new Route('POST', 'addRegister', '/register', [MembreController::class, 'inscription']),
            new Route('POST', 'updateMembreRegister', '/updateMembreRegister', [MembreController::class, 'updateMembreRegister']),
            new Route('POST', 'loginVerif', '/loginVerif', [MembreController::class, 'login']),
            new Route('POST', 'mdpUpdate', '/mdpUpdate', [MembreController::class, 'mdpUpdate']),
            new Route('POST', 'updatePost', '/updatePost', [BlogListController::class, 'updatePostById']),
            new Route('POST', 'updateSignal', '/updateSignal', [BlogListController::class, 'updateSignalCommentById']),
            new Route('POST', 'deletePost', '/deletePost', [BlogListController::class, 'deletePostId']),
            new Route('POST', 'deleteReport', '/deleteReport', [AdminController::class, 'deleteReportNotApprouved']),
            new Route('POST', 'updateReport', '/updateReport', [AdminController::class, 'approuvedReport']),
        ];

        foreach ($this -> routes as $route) {
            $this->router-> add($route);
        }


        $match = $this->router->match($this->methode, "/$this->url");
        if (!$match) {
            return $config->render("layout.php", "error404.php", array());
        }

        return $this->router->call($this->methode, "/$this->url");
    }

    /**
     * @param $name
     * @return Route|null
     */
    public function findNameRoute($name)
    {
        return $this->router->find($name);
    }

}
