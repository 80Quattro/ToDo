<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Controller;
use App\Models\Room;
use App\Models\ToDo;
use App\View;

class RoomController extends Controller
{
    public function create(): void
    {
        $roomId = (new Room)->create($this->post['name']);
        header("Location: /room?id=$roomId");
    }

    public function join(): string
    {
        (new ToDo)->getAllByRoomId($this->get['id']);
        return (
            new View(
                templatePath: 'indexTemplate', 
                viewPath: 'room', 
                params: [
                    'title' => 'ToDo App',
                    'stylesheets' => [
                        'css/index.css',
                        'css/room.css'
                    ],
                    'scripts' => [
                        'js/cookies.js',
                        'js/room.js'
                    ]
                ]
            )
        )->render();
    }

    public function addToDo(): string
    {
        (new ToDo)->create(
            $this->body->roomId,
            $this->body->name, 
            $this->body->description,
            $this->body->owner
        );
        return json_encode( array('status' => 'SUCCESS') );
    }

    public function getToDos(): string
    {
        $todos = (new ToDo)->getAllByRoomId($this->body->roomId);
        return json_encode([
            'status' => 'SUCCESS',
            'todos' => $todos
        ]);
    }

}