<?php

declare(strict_types = 1);

use App\App;
use App\Controllers\HomeController;
use App\Controllers\RoomController;
use App\DBConfig;
use App\Router;

require_once(__DIR__ . '/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('VIEWS_DIR_PATH', __DIR__ . '/Views/');

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($request, $method, $_POST, $_GET);

$router
    ->get('/', [HomeController::class, 'index'])
    ->post('/create', [RoomController::class, 'create'])
    ->get('/room', [RoomController::class, 'join']);

(new App(
    $router, 
    new DBConfig($_ENV)
    )
)->run();