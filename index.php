<?php
require __DIR__ . '/vendor/autoload.php';

use Core\View;

View::$basePath = __DIR__ . '/app/views';
$router = require __DIR__ . '/routes/web.php';
$router->resolve($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
