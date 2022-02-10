<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router 
{

    private array $routes;

    public function __construct(
        private string $request, 
        private string $method, 
        private array $post = array(), 
        private array $get = array()
        )
    {
        
    }

    public function register(string $request, string $method, callable|array $action): self
    {
        $this->routes[$method][$request] = $action;

        return $this;
    }

    public function get(string $request, callable|array $action): self
    {
        return $this->register($request, 'GET', $action);
    }

    public function post(string $request, callable|array $action): self
    {
        return $this->register($request, 'POST', $action);
    }

    public function resolve()
    {
        $action = $this->routes[$this->method][$this->request];

        if($action == null) {
            throw new RouteNotFoundException();
        }

        if(is_callable($action)) {
            return call_user_func($action);
        }
        
        if(is_array($action)) {
            [$class, $method] = $action;

            if(class_exists($class)) {
                $class = new $class($this->post, $this->get);

                if(method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }

}