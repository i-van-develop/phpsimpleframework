<?php namespace App\Router\Request;

use App\Router\Route;

class RequestComparator
{
    /** @var string */
    private $request;

    /**
     * RequestComparator constructor.
     * @param string $request
     */
    public function __construct(string $request)
    {
        $this->request = $request;
    }

    private function explodePath(string $path)
    {
        return explode('/',trim($path, '/'));
    }

    private function isVariable(string $pathItem){
        if ($pathItem[0] == '{' && $pathItem[strlen($pathItem) -1] == '}'){
            return true;
        }
        return false;
    }

    public function compare(Route $route)
    {
        $eMass = $this->explodePath($this->request);
        $ePath = $this->explodePath($route->path);

        $requestCompareFailure = new RequestCompareResult($this->request, $route->path, false);
        if (count($eMass) != count($ePath)) {
            return $requestCompareFailure;
        }

        $variables = [];
        foreach ($ePath as $index => $ePathItem) {
            $eMassItem = $eMass[$index];
            if ($this->isVariable($ePathItem)) {
                foreach ($route->binds as $bind){
                    if ("{{$bind->variable}}" == $ePathItem){
                        if (!$bind->checkValue($eMassItem)){
                            return $requestCompareFailure;
                        }
                    }
                }
                $variables[$ePathItem] = $eMassItem;
            } else if ($ePathItem != $eMassItem) {
                return $requestCompareFailure;
            }
        }

        return new RequestCompareResult($this->request, $route->path, true, $variables);
    }
}