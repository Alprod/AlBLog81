<?php
namespace Tests;


use App\Router\Route;
use App\Router\RouteAlreadyExistExecption;
use App\Router\RouteNotFoundException;
use App\Router\Router;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Tests\Controller\BlogController;
use Tests\Controller\HomeController;

class RouterTest extends TestCase
{

    public function testRouter(): void
    {
        $router = new Router();

        $route = new Route('GET','home', '/', [HomeController::class, "index"]);
        $routeContacrt = new Route('POST','contact', '/contact', [BlogController::class, "blog"]);

        $router->add($route);
        $router->add($routeContacrt);

        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->findRouteName("home"));
        $this->assertEquals($routeContacrt, $router->findRouteName("contact"));

        $this->assertEquals('Bienvenu dans mon site', $router->call('GET',"/"));
        $this->assertEquals('blog', $router->call('POST',"/contact"));

    }

    public function testMatch(): void
    {
        $router = new Router();
        $route = new Route('POST','contact', '/contact', [BlogController::class, "blog"]);
        $router->add($route);
        $this->assertEquals($route, $router->match('POST',"/contact"));

    }

    /**
     * @return \string[][]
     */
    public function dataProviderMatchThrowExecptionMethod(): array
    {
        return [
            "Aucun des arguments n'est valide" =>
               [
                'GET',
                '/membre'
            ],
            "Le Path non valide" => [
                'POST',
                'mercredi'
            ],
            "Le methode non valide" => [
                'PUT',
                '/contact'
            ]
        ];
    }

    /**
     * @param $method
     * @param $path
     * @dataProvider dataProviderMatchThrowExecptionMethod
     * @throws RouteAlreadyExistExecption
     * @throws RouteNotFoundException
     */
    public function testMatchThrowExecptionMethod($method, $path): void
    {
        $router = new Router();
        $route = new Route('POST','contact', '/contact', [BlogController::class, "blog"]);
        $router->add($route);
        $this->expectException(RouteNotFoundException::class);
        $router->match($method, $path);
    }

    /**
     * @throws RouteAlreadyExistExecption
     * @throws RouteNotFoundException|ReflectionException
     */
    public function testRouterByIdsWithSlug(): void
    {
        $router = new Router();
        $route = new Route('GET',"blog-post", '/{id}/{slug}', static fn(string $slug, string $id): string => sprintf("%s/%s", $slug, $id));
        $routeBlogPost = new Route('POST',"membres", "/{id}/my-post", [BlogController::class, "blogPost"]);
        $router->add($routeBlogPost);
        $router->add($route);


        $this->assertCount(2,$router->getRouterCollection());

        $this->assertContainsOnlyInstancesOf(Route::class,$router->getRouterCollection());

        $this->assertEquals($route, $router->findRouteName("blog-post"));
        $this->assertEquals($routeBlogPost, $router->findRouteName("membres"));


        $this->assertEquals("journal/12", $router->call('GET',"/12/journal"));
        $this->assertEquals("Mon article n° 2", $router->call('POST',"/2/my-post"));
    }

    /**
     * Verifier la route si elle est recuperer
     * @throws RouteNotFoundException
     */
    public function testIfNotFoundRouteByName(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundException::class);
        $router->findRouteName("fail");

    }

    /**
     * Verfier le matching des pages
     * @throws RouteNotFoundException
     */
    public function testIfNotFoundRouteByMatch(): void
    {
        $router = new Router();

        $this->expectException(RouteNotFoundException::class);
        $router->match('POST',"/");

    }

    /**
     * Verifier si notre route Existe déjà
     * @throws RouteAlreadyExistExecption
     */
    public function testIfRouteAlreadyExist(): void
    {
        $router = new Router();
        $route = new Route('GET',"home","/", static function (){});

        $router->add($route);
        $this->expectException(RouteAlreadyExistExecption::class);
        $router->add($route);
    }

}