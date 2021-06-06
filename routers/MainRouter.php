<?php

namespace routers;

use controllers;
use Exception;

require("Routes.php");

class MainRouter
{
    protected $routes = null;

    function __construct(String $path)
    {
        $this->routes = new Routes();
        // assign routes
        $this->routes->get("/", "controllers/HomeController.php");
        $this->routes->get("/login", "controllers/LoginController.php");
        // call controller
        $this->getController($path);
    }

    function explode(String $path)
    {
        $parts = explode("/", $path);
        $results = [];
        foreach ($parts as $part) {
            if (strlen($part) > 0) {
                $results[] = $part;
            }
        }
        return $results;
    }

    function normalize(String $path)
    {
        $parts = $this->explode($path);
        $path = "/" . (count($parts) > 0 ? join("/", $parts) : "");
        return $path;
    }

    function getController(String $path)
    {
        $path = $this->normalize($path);
        // echo $this->routes->getRoutes()[0]->path;
        foreach ($this->routes->getRoutes() as $route) {
            if (str_starts_with($route->path, $path)) { // check path
                if ($_SERVER['REQUEST_METHOD'] === $route->method) { // check method
                    try {
                        // get controller name
                        $path = "/".substr($path, strlen($route->path));
                        $controllerName = $this->explode($route->controller);
                        $controllerName = end($controllerName);
                        $controllerName = preg_replace("/.php/", "", $controllerName);
                    } catch (Exception $e) {
                        $this->callNotFoundController();
                        return;
                    }
                    $this->callController(
                        $route->controller, 
                        "controllers\\".$controllerName,
                        $path
                    );
                    return;
                }
            }
        }
        $this->callNotFoundController();
    }

    function callController($controllerPath, $controllerName, $path = '/') {
        require($controllerPath);
        $refl = new \ReflectionClass($controllerName);
        $refl->newInstanceArgs(array($path));
    }

    function callNotFoundController() {
        $this->callController(
            "controllers/NotFoundController.php", 
            "controllers\NotFoundController"
        );
    }
}
