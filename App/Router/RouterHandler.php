<?php namespace App\Router;

use App\Router\Request\RequestComparator;
use App\Router\Request\Request;

/**
 * Class RouterHandler
 * @package App\Router
 *
 */
class RouterHandler
{
    /** @var Router */
    private $router;
    /** @var string */
    private $requestPath;
    /** @var string */
    private $requestMethod;

    /**
     * RouterHandler constructor.
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
        $this->requestPath = parse_url($_SERVER['REQUEST_URI'])['path'];
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    private function executeControllerAction(ControllerAction $controllerAction, $request)
    {
        $reflectionClass = new \ReflectionClass($controllerAction->controller);
        $controller = $reflectionClass->newInstanceArgs([$request]);
        $controller->{$controllerAction->action}();
    }

    public function proceed()
    {
        $handled = false;
        $requestComparator = new RequestComparator($this->requestPath);
        foreach ($this->router->getRoutes() as $route) {
            if ($this->requestMethod == $route->type){
                $requestCompareResult = $requestComparator->compare($route);
                if ($requestCompareResult->isEquals){
                    $handled = true;
                    $request = new Request($this->requestPath,$requestCompareResult->variables);
                    $this->executeControllerAction($route->controllerAction, $request);
                    break;
                }
            }
        }
        if (!$handled){
            $controllerActions404 = $this->router->getControllerActions404();
            if (array_key_exists($this->requestMethod,$controllerActions404)){
                $request = new Request($this->requestPath, []);
                $this->executeControllerAction($controllerActions404[$this->requestMethod], $request);
            }
        }
    }
}