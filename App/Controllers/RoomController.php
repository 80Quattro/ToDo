<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\View;

class RoomController 
{
    public function create(): string
    {
        return (
            new View(
                templatePath: 'indexTemplate', 
                viewPath: 'room', 
                params: [
                    'title' => 'ToDo App',
                ]
            )
        )->render();
    }

    public function join(): string
    {
        return (
            new View(
                templatePath: 'indexTemplate', 
                viewPath: 'room', 
                params: [
                    'title' => 'ToDo App',
                ]
            )
        )->render();
    }
}