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

    public function testRouter(): void
    {
        $router = new Router();

        $route = new Route('GET','home', '/', [HomeController::class, "index"]);
        $routeBlog = new Route('POST','contact', '/contact', [BlogController::class, "blog"]);

        $router->add($route);
        $router->add($routeBlog);

        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("GET"));
        $this->assertEquals($routeBlog, $router->get("POST"));

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
        $route = new Route("GET", 'blog-post/{id}/{slug}', function (string $slug, string $id) { return sprintf("%s/%s", $slug, $id); });
        $routeBlogPost = new Route("GET", "blog-post/{id}/my-post", [BlogController::class, "blogPost"]);
        $router->add($routeBlogPost);
        $router->add($route);


        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("GET"));
        $this->assertEquals($routeBlogPost, $router->get("GET"));


        $this->assertEquals("journal/12", $router->call("/12/journal"));
        $this->assertEquals("1", $router->call("/1/my-post"));
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