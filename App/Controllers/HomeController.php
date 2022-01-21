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
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css',
                        'css/index.css'
                    ]
                ]
            )
        )->render();
    }
}