<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): string
    {
        return (
            new View(
                templatePath: 'indexTemplate', 
                viewPath: 'home', 
                params: [
                    'title' => 'ToDo App',
                    'stylesheets' => [
                        'css/index.css'
                    ],
                    'scripts' => [
                        'js/index.js'
                    ]
                ]
            )
        )->render();
    }
}