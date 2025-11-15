<?php

use Core\Router;
use App\Controllers\NameController;

$router = new Router();

$router->get('/', [NameController::class, 'index']);

return $router;
