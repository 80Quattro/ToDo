<?php

declare(strict_types = 1);

namespace App;

use stdClass;

abstract class Controller
{

    public function __construct(protected stdClass $body, protected array $post = [], protected array $get = [])
    {

    }

    public static function page404(): string
    {
        return (new View(
            templatePath: 'indexTemplate', 
            viewPath: '404',
            params: [
                'title' => '404 Page not found / ToDo App',
                'stylesheets' => [
                    'css/index.css',
                    'css/404.css'
                ],
            ]
        ))->render();
    }
}