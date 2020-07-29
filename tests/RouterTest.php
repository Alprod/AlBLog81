<?php
namespace Router\Tests;


use App\Route;
use App\RouteAlreadyExistExecption;
use App\RouteNotFoundExecption;
use App\Router;
use PHPUnit\Framework\TestCase;
use Router\Tests\Fixtures\BlogController;
use Router\Tests\Fixtures\HomeController;

class RouterTest extends TestCase
{

    public function testRouter()
    {
        $router = new Router();

        $route = new Route('home', '/', [HomeController::class, "index"]);
        $routeBlog = new Route('blog', '/blog', [BlogController::class, "blog"]);

        $router->add($route);
        $router->add($routeBlog);

        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("home"));
        $this->assertEquals($routeBlog, $router->get("blog"));

        $this->assertEquals($route, $router->match("/"));
        $this->assertEquals($routeBlog, $router->match("/blog"));


        $this->assertEquals('Bienvenu dans mon site', $router->call("/"));
        $this->assertEquals('blog', $router->call("/blog"));

    }

    /**
     * @throws RouteAlreadyExistExecption
     * @throws RouteNotFoundExecption
     */
    public function testRouterByIdsWithSlug()
    {
        $router = new Router();
        $route = new Route('blog-post', '/{id}/{slug}', function (string $slug, string $id) { return printf("%s/%s", $slug, $id); });
        $routeBlogPost = new Route("my-post", "/my-post/{id}", [BlogController::class, "BlogPost"]);
        $router->add($route);
        $router->add($routeBlogPost);


        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("blog-post"));
        $this->assertEquals($routeBlogPost, $router->get("my-post"));


        $this->assertEquals("10", $router->call("/12/journal"));
        $this->assertEquals("9", $router->call("/1/my-post"));
    }

    /**
     * Verifier la route si elle est recuperer
     * @throws RouteNotFoundExecption
     */
    public function testIfNotFoundRouteByGet()
    {
        $router = new Router();

        $this->expectException(RouteNotFoundExecption::class);
        $router->get("fail");

    }

    /**
     * Verfier le matching des pages
     * @throws RouteNotFoundExecption
     */
    public function testIfNotFoundRouteByMatch()
    {
        $router = new Router();

        $this->expectException(RouteNotFoundExecption::class);
        $router->match("/");

    }

    /**
     * Verifier si notre route Existe déjà
     * @throws RouteAlreadyExistExecption
     */
    public function testIfRouteAlreadyExist()
    {
        $router = new Router();
        $route = new Route("home","/", function (){});

        $router->add($route);
        $this->expectException(RouteAlreadyExistExecption::class);
        $router->add($route);
    }

}