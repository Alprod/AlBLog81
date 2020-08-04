<?php
namespace Tests;


use App\Router\Route;
use App\Router\RouteAlreadyExistExecption;
use App\Router\RouteNotFoundExecption;
use App\Router\Router;
use PHPUnit\Framework\TestCase;
use Tests\Controller\BlogController;
use Tests\Controller\HomeController;

class RouterTest extends TestCase
{

    public function testRouter(): void
    {
        $router = new Router();

        $route = new Route('home', '/', [HomeController::class, "index"]);
        $routeContacrt = new Route('contact', '/contact', [BlogController::class, "blog"]);

        $router->add($route);
        $router->add($routeContacrt);

        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("home"));
        $this->assertEquals($routeContacrt, $router->get("contact"));

        $this->assertEquals($route, $router->match("/"));
        $this->assertEquals($routeContacrt, $router->match("/contact"));


        $this->assertEquals('Bienvenu dans mon site', $router->call("/"));
        $this->assertEquals('blog', $router->call("/contact"));

    }

    /**
     * @throws RouteAlreadyExistExecption
     * @throws RouteNotFoundExecption
     */
    public function testRouterByIdsWithSlug(): void
    {
        $router = new Router();
        $route = new Route("blog-post", '/{id}/{slug}', function (string $slug, string $id) { return sprintf("%s/%s", $slug, $id); });
        $routeBlogPost = new Route("membres", "/{id}/my-post", [BlogController::class, "blogPost"]);
        $router->add($routeBlogPost);
        $router->add($route);


        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->get("blog-post"));
        $this->assertEquals($routeBlogPost, $router->get("membres"));


        $this->assertEquals("journal/12", $router->call("/12/journal"));
        $this->assertEquals("1", $router->call("/1/my-post"));
    }

    /**
     * Verifier la route si elle est recuperer
     * @throws RouteNotFoundExecption
     */
    public function testIfNotFoundRouteByGet(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundExecption::class);
        $router->get("fail");

    }

    /**
     * Verfier le matching des pages
     * @throws RouteNotFoundExecption
     */
    public function testIfNotFoundRouteByMatch(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundExecption::class);
        $router->match("/");

    }

    /**
     * Verifier si notre route Existe déjà
     * @throws RouteAlreadyExistExecption
     */
    public function testIfRouteAlreadyExist(): void
    {
        $router = new Router();
        $route = new Route("home","/", function (){});

        $router->add($route);
        $this->expectException(RouteAlreadyExistExecption::class);
        $router->add($route);
    }

}