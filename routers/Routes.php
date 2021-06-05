<?php
namespace routers;

class Method {
    public $path;
    public $controller;
    public $method;

    function __construct(String $path, String $controller, String $method) {
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
    }
}

class Routes {
    private $routes = [];

    function __construct() {}

    function get(String $path, String $controller) {
        $this->routes[] = new Method($path, $controller, "GET");
    }

    function post(String $path, String $controller) {
        $this->routes[] = new Method($path, $controller, "post");
    }

    function getRoutes() {
        return $this->routes;
    }
}
?>