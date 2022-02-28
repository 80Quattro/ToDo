<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFoundException;
use stdClass;

class Router 
{

    private array $routes;

    public function __construct(
        private string $request, 
        private string $method, 
        private stdClass $body,
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

    public function put(string $request, callable|array $action): self
    {
        return $this->register($request, 'PUT', $action);
    }

    public function delete(string $request, callable|array $action): self
    {
        return $this->register($request, 'DELETE', $action);
    }

    public function resolve()
    {
        // first check the perfect match (with no params) - highest priotity
        // than check match with param

        $this->request = explode('?', $this->request)[0];
        $action = $this->routes[$this->method][$this->request];
        //$action = explode('?', $action)[0];

        /* $action = $this->routes[$this->method];
        foreach($action as $routeName => $route) {
            echo "<pre>";
            var_dump($this->routes);
            echo $this->request;
            echo $this->method;
            echo "</pre>";

            $request = explode('/', $this->request);
            var_dump($request);
            $routeName = explode('/', $routeName);
            var_dump($routeName);

            if(count($request) === count($routeName)) {
                $dismatch = false;
                for($i = 0; $i < count($request); $i++) {
                    if(str_starts_with($route, ':')) {

                    }
                }
            }
        } */

        if($action == null) {
            throw new RouteNotFoundException();
        }

        if(is_callable($action)) {
            return call_user_func($action);
        }
        
        if(is_array($action)) {
            [$class, $method] = $action;

            if(class_exists($class)) {
                $class = new $class($this->body, $this->post, $this->get);

                if(method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }

}