<?php

declare(strict_types = 1);

namespace App;

class App
{

    public function __construct(private Router $router)
    {
        
    }

    public function run()
    {
        // TODO try catch
        echo $this->router->resolve();
    }

}