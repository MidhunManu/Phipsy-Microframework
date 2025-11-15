<?php

namespace Core;

class Router
{
    protected array $routes = [];

    public function get(string $uri, callable|array $action)
    {
        $this->routes['GET'][$uri] = $action;
    }

    public function post(string $uri, callable|array $action)
    {
        $this->routes['POST'][$uri] = $action;
    }

    public function resolve(string $method, string $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 Not Found";
            exit;
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        [$controller, $method] = $action;
        $controller = new $controller;
        return $controller->$method();
    }
}
