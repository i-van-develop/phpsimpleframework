<?php namespace App\Router;

/**
 * Class Router
 * @package App\Router
 */
class Router
{
    /** @var Route[]  */
    private $routes;

    /** @var ControllerAction[] */
    private $controllerActions404;

    public function __construct()
    {
        $this->routes = [];
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    private function routeAdd(string $type, string $path, ControllerAction $controllerAction)
    {
        $route = new Route($type, $path, $controllerAction);
        $this->routes []= $route;
        return $route;
    }

    public function get(string $path, ControllerAction $controllerAction)
    {
        return $this->routeAdd(Route::TYPE_GET, $path, $controllerAction);
    }

    public function post(string $path, ControllerAction $controllerAction)
    {
        return $this->routeAdd(Route::TYPE_POST, $path, $controllerAction);
    }

    /**
     * @return ControllerAction[]
     */
    public function getControllerActions404(): array
    {
        return $this->controllerActions404;
    }

    public function add404ControllerAction(string $type, ControllerAction $controllerAction){
        $this->controllerActions404[$type] = $controllerAction;
    }
}