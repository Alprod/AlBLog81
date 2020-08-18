<?php
namespace App\Router;

use ReflectionException;

/**
 * Class Router
 */
class Router
{
    /**
     * @var Route[]
    */
    private array $routes = [];

    /**
     *Add new route
     *
     * @param Route $route
     *
     * @return $this
     *
     * @throws RouteAlreadyExistExecption
     */
    public function add(Route $route):self
    {
        if($this->has($route->getName())){
            throw new RouteAlreadyExistExecption('This route Exist');
        }
        $this->routes[$route->getName()] = $route;
        return $this;
    }

    /**
     * Insert all routes into a table
     *
     * @return Route[]|array
     *
     */
    public function getRouterCollection():array
    {
        return $this->routes;
    }

    /**
     * The road is not to find
     *
     * @param string $name
     *
     * @return Route
     *
     * @throws RouteNotFoundException
     */
    public function findRouteName(string $name): ?Route
    {
        if(!$this->has($name)){
            throw new RouteNotFoundException('No Route found');
        }
        return $this->routes[$name];
    }

    /**
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->routes[$name]);
    }

    /**
     * Check the method as well as the path of the route
     *
     * @param string $path
     *
     * @param string $method
     *
     * @return Route
     *
     * @throws RouteNotFoundException
     */
    public function match(string $method,string $path): Route
    {
        foreach ($this->routes as $route) {
            if ($route->testMatchIds($path) && $route->getMethode() === $method) {
                return $route;
            }
        }
        throw new RouteNotFoundException('Route non trouver');
    }

    /**
     * @param string $method
     *
     * @param string $path
     *
     * @return mixed
     *
     * @throws RouteNotFoundException
     *
     * @throws ReflectionException
     */
    public function call( string $method, string $path )
    {
        return $this->match( $method, $path )->call( $path );
    }
}
