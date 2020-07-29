<?php
namespace App;

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
     * Ajouter de nouvelle route
     * @param Route $route
     * @return $this
     * @throws RouteAlreadyExistExecption
     */
    public function add(Route $route):self
    {
        if($this->has($route->getName())){
            throw new RouteAlreadyExistExecption();
        }
        $this->routes[$route->getName()] = $route;

        return $this;
    }

    /**
     * Insert dans un tableau toutes les routes
     * @return Route[]|array
     */
    public function getRouterCollection():array
    {
        return $this->routes;
    }

    /**
     * La route n'est pas trouver
     * @param string $name
     * @return Route
     * @throws RouteNotFoundExecption
     */
    public function get(string $name): ?Route
    {
        if(!$this->has($name)){
            throw new RouteNotFoundExecption();
        }
        return $this->routes[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return isset($this->routes[$name]);
    }

    /**
     * @param string $path
     * @return Route
     * @throws RouteNotFoundExecption
     */
    public function match(string $path): Route
    {
        foreach ($this->routes as $route) {
            if ($route->testMatchIds($path)) {
                return $route;
            }
        }
        throw new RouteNotFoundExecption();
    }

    public function call(string $path)
    {
        return $this->match($path)->call($path);
    }
}