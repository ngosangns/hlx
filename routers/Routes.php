<?php
class Method
{
    public $path;
    public $controller;
    public $method;

    public function __construct(String $path, String $controller, String $method)
    {
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
    }
}

class Routes
{
    private $routes = [];

    public function __construct()
    {
    }

    public function get(String $path, String $controller)
    {
        $this->routes[] = new Method($path, $controller, "GET");
    }

    public function post(String $path, String $controller)
    {
        $this->routes[] = new Method($path, $controller, "post");
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
