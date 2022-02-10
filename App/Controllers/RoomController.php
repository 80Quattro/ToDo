<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Controller;
use App\Models\Room;
use App\View;

class RoomController extends Controller
{
    public function create(): string
    {
        echo (new Room)->create($this->post['name']);
        return (
            new View(
                templatePath: 'indexTemplate', 
                viewPath: 'room', 
                params: [
                    'title' => 'ToDo App',
                    'scripts' => [
                        'js/index.js'
                    ]
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