<?php

declare(strict_types = 1);

namespace App;

class App
{

    private static DBConfig $dbConfig;

    public function __construct(private Router $router, DBConfig $dbConfig)
    {
        static::$dbConfig = $dbConfig;
    }

    public function run()
    {
        // TODO try catch and 404 page
        echo $this->router->resolve();
    }

    public static function getDBConfig(): DBConfig
    {
        return static::$dbConfig;
    }

}