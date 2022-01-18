<?php

declare(strict_types = 1);

namespace App;

class Router 
{

    private array $routes;

    public function __construct(private string $request, private string $method)
    {
        
    }

    public function register(string $request, string $method, callable|array $action): self
    {
        $this->routes[$method][$request] = $action;

        return $this;
    }

    public function get(string $request, callable|array $action): self
    {
        return $this->register($request, 'get', $action);
    }

    public function post(string $request, callable|array $action): self
    {
        return $this->register($request, 'post', $action);
    }

    public function resolve()
    {

    }

}