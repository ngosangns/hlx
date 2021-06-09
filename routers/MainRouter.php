<?php
require("Routes.php");

class MainRouter
{
    protected $routes = null;

    public function __construct(String $path)
    {
        $this->routes = new Routes();
        // assign routes
        $this->routes->get("/", "controllers/HomeController.php");
        $this->routes->get("/login", "controllers/LoginController.php");
        $this->routes->get("/register", "controllers/RegisterController.php");
        $this->routes->get("/profile", "controllers/ProfileController.php");
        $this->routes->get("/advanced-search", "controllers/AdvanSearchController.php");
        // call controller
        $this->getController($path);
    }

    public function explode(String $path)
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

    public function normalize(String $path)
    {
        $parts = $this->explode($path);
        $path = "/" . (count($parts) > 0 ? join("/", $parts) : "");
        return $path;
    }

    public function getController(String $path)
    {
        $path = $this->normalize($path);
        foreach ($this->routes->getRoutes() as $route) {
            if (str_starts_with($path, $route->path)) { // check path
                // check homepage
                if ($route->path == "/" && strlen($path) > 1) {
                    continue;
                }
                if ($_SERVER['REQUEST_METHOD'] === $route->method) { // check method
                    try {
                        // get controller name
                        $path = substr($path, strlen($route->path));
                        // check empty path
                        if (strlen($path) === 0) {
                            $path = "/".$path;
                        }
                        $controllerName = $this->explode($route->controller);
                        $controllerName = end($controllerName);
                        $controllerName = preg_replace("/.php/", "", $controllerName);
                    } catch (Exception $e) {
                        $this->callNotFoundController();
                        return;
                    }
                    $this->callController(
                        $route->controller,
                        $controllerName,
                        $path
                    );
                    return;
                }
            }
        }
        $this->callNotFoundController();
    }

    public function callController($controllerPath, $controllerName, $path = '/')
    {
        require($controllerPath);
        $refl = new \ReflectionClass($controllerName);
        $refl->newInstanceArgs(array($path));
    }

    public function callNotFoundController()
    {
        $this->callController(
            "controllers/NotFoundController.php",
            "NotFoundController"
        );
    }
}
