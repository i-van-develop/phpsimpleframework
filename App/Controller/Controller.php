<?php namespace App\Controller;

use App\Router\Request\Request;

class Controller
{
    /** @var Request */
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}