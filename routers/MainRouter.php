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

    public function getController(String $path)
    {
        $path = normalizePath($path);
        if (checkCharacterPath($path)) {
            foreach ($this->routes->getRoutes() as $route) {
                if (str_starts_with($path, $route->path)) { // check path
                    // check homepage
                    if ($route->path == "/" && strlen($path) > 1) {
                        continue;
                    } elseif (strlen($path) > strlen($route->path) && $path[strlen($route->path)] != "/") {
                        continue;
                    }
                    if ($_SERVER['REQUEST_METHOD'] === $route->method) { // check method
                        try {
                            $path = getSubPath($path, $route->path);
                            $controllerName = explodePath($route->controller);
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
