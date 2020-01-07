<?php


namespace App\Router;


class ControllerAction
{
    /** @var string */
    public $controller;
    /** @var string */
    public $action;

    /**
     * ControllerAction constructor.
     * @param string $controller
     * @param string $action
     */
    public function __construct(string $controller, string $action)
    {
        $this->controller = $controller;
        $this->action = $action;
    }
}