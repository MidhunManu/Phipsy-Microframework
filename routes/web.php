<?php

use App\Controllers\UserController;
use Core\Router;
use App\Controllers\NameController;

$router = new Router();

$router->get('/', [NameController::class, 'index']);
$router->get('/users', [UserController::class, 'index']);
$router->get('/users/{id}', [UserController::class, 'show']);
return $router;
