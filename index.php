<?php

declare(strict_types = 1);

use App\App;
use App\Controllers\HomeController;
use App\Router;

require_once(__DIR__ . '/vendor/autoload.php');

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router = new Router($request, $method);

$router
    ->get('/', [HomeController::class, 'index']);

(new App($router))->run();