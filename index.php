<?php

declare(strict_types = 1);

use App\App;
use App\Controllers\HomeController;
use App\Controllers\RoomController;
use App\DBConfig;
use App\Router;

require_once(__DIR__ . '/vendor/autoload.php');

// library to read .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// path to directory with views
define('VIEWS_DIR_PATH', __DIR__ . '/Views/');

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$body = json_decode(file_get_contents('php://input')) ?? (object) array();

$router = new Router($request, $method, $body, $_POST, $_GET);

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/create', [RoomController::class, 'create'])
    ->get('/room', [RoomController::class, 'join'])
    ->post('/room/addToDo', [RoomController::class, 'addToDo'])
    ->post('/room/getToDos', [RoomController::class, 'getToDos'])
    ->put('/room/changeToDo', [RoomController::class, 'changeToDo'])
    ->delete('/room/deleteToDo', [RoomController::class, 'deleteToDo']);

(new App(
    $router, 
    new DBConfig($_ENV)
    )
)->run();