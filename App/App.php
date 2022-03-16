<?php

declare(strict_types = 1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class App
{

    private static DBConfig $dbConfig;

    public function __construct(private Router $router, DBConfig $dbConfig)
    {
        static::$dbConfig = $dbConfig;
    }

    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch(RouteNotFoundException $e) {
            echo Controller::page404();
        }
    }

    public static function getDBConfig(): DBConfig
    {
        return static::$dbConfig;
    }

}