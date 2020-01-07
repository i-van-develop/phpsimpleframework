<?php namespace App\Application;

use App\Router\Router;
use App\Router\RouterHandler;

class Application
{
    /** @var Router */
    private $router;

    /** @var bool */
    private $isInit;

    public function __construct()
    {
        $this->isInit = false;
    }

    public function __destruct()
    {
        if (!empty($this->router->getRoutes())){
            $routerHandler = new RouterHandler($this->router);
            $routerHandler->proceed();
        }
    }

    function init()
    {
        if (!$this->isInit) {
            $this->router = new Router();
            $this->isInit = false;
        }
    }

    public function getRouter()
    {
        return $this->router;
    }
}