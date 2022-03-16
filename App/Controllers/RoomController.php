<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Controller;
use App\Exceptions\DataNotFoundException;
use App\Models\Room;
use App\Models\ToDo;
use App\View;
use stdClass;

class RoomController extends Controller
{
    public function create(): void
    {
        $roomId = (new Room)->create($this->post['name']);
        header("Location: /room?id=$roomId");
    }

    public function join(): string
    {
        $message = '';
        
        try {
            (new Room)->get($this->get['id']);
        } catch( DataNotFoundException ) {
            $message = 'RoomNotFound';
        }

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
                    ],
                    'message' => $message,
                ]
            )
        )->render();
    }

    public function addToDo(): string
    {
        $insertedId = (new ToDo)->create(
            $this->body->roomId,
            $this->body->name, 
            $this->body->description,
            $this->body->owner
        );
        return json_encode( array(
                'status' => 'SUCCESS',
                'insertedId' => $insertedId
            ) );
    }

    public function getToDos(): string
    {
        $todos = (new ToDo)->getAllByRoomId($this->body->roomId);
        return json_encode([
            'status' => 'SUCCESS',
            'todos' => $todos
        ]);
    }

    public function changeToDo(): string
    {
        (new ToDo)->change($this->body->todoId, (array) $this->body->toChange);
        return json_encode([
            'status' => 'SUCCESS',
        ]);
    }

    public function deleteToDo(): string
    {
        (new ToDo)->delete($this->body->todoId);
        return json_encode([
            'status' => 'SUCCESS',
        ]);
    }

}