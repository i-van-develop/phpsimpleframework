<?php namespace App\Router\Request;

class Request
{
    /** @var string */
    public $path;
    /** @var array */
    public $pathVariables;

    /**
     * Request constructor.
     * @param string $path
     * @param array $pathVariables
     */
    public function __construct(string $path, array $pathVariables)
    {
        $this->path = $path;
        $this->pathVariables = $pathVariables;
    }
}