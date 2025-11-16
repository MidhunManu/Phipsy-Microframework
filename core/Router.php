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
    $action = null;
    $params = [];

    foreach ($this->routes[$method] ?? [] as $route => $a) {
        $pattern = preg_replace('/\{(\w+)\}/', '(\w+)', $route);
        if (preg_match("#^$pattern$#", $uri, $matches)) {
            $action = $a;
            array_shift($matches); // first element is full match
            preg_match_all('/\{(\w+)\}/', $route, $keys);
            $params = array_combine($keys[1], $matches);
            break;
        }
    }

    if (!$action) {
        http_response_code(404);
        echo "404 Not Found";
        exit;
    }

    if (is_callable($action)) {
        return call_user_func($action, new Request($params));
    }

    [$controller, $method] = $action;
    $controller = new $controller;
    return $controller->$method(new Request($params));
    }
}
