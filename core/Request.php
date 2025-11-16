<?php

namespace Core;

class Request
{
    protected array $get = [];
    protected array $post = [];
    protected array $server = [];
    protected array $headers = [];
    protected array $json = [];
    protected array $params = [];

    public function __construct(array $params = [])
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->headers = getallheaders();
        $this->params = $params;

        $input = file_get_contents('php://input');
        $json = json_decode($input, true);
        $this->json = $json ?: [];
    }

    public function method(): string
    {
        return $this->server['REQUEST_METHOD'] ?? 'GET';
    }

    public function path(): string
    {
        return parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    }

    public function query(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function input(string $key, $default = null)
    {
        return $this->post[$key] ?? $this->json[$key] ?? $default;
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post, $this->json);
    }

    public function header(string $key, $default = null)
    {
        return $this->headers[$key] ?? $default;
    }

    public function param(string $key, $default = null)
    {
        return $this->params[$key] ?? $default;
    }
}
