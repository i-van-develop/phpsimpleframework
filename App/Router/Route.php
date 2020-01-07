<?php namespace App\Router;

class Route
{
    const TYPE_GET = 'GET';
    const TYPE_POST = 'POST';

    /** @var string */
    public $type;
    /** @var string */
    public $path;
    /** @var ControllerAction */
    public $controllerAction;

    /** @var RouteBind[] */
    public $binds;

    /**
     * Route constructor.
     * @param string $type
     * @param string $path
     * @param ControllerAction $controllerAction
     */
    public function __construct(string $type, string $path, ControllerAction $controllerAction)
    {
        $this->type = $type;
        $this->path = $path;
        $this->controllerAction = $controllerAction;
        $this->binds = [];
    }

    public function bind(string $variableName, string $type, ?callable $filterFunction = null)
    {
        $this->binds[]= new RouteBind($variableName, $type, $filterFunction);
    }
}