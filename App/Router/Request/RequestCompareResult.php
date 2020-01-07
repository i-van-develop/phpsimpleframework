<?php


namespace App\Router\Request;


class RequestCompareResult
{
    /** @var string */
    public $request;
    /** @var string */
    public $path;

    /** @var bool */
    public $isEquals;
    /** @var array|null */
    public $variables;

    /**
     * RequestCompareResult constructor.
     * @param string $request
     * @param string $path
     * @param bool $isEquals
     * @param array|null $variables
     */
    public function __construct(string $request, string $path, bool $isEquals, ?array $variables = null)
    {
        $this->request = $request;
        $this->path = $path;
        $this->isEquals = $isEquals;
        $this->variables = $variables;
    }
}