<?php
require("BaseController.php");

class HomeController extends BaseController
{
    private $viewPath = "views/templates/MainTemplate.php";

    public function __construct(String $path)
    {
        if ($path === "/") {
            $vm = new ObjectViewModel();
            $view = require $this->viewPath;
            $child = require "views/HomeView.php";
            $view = $view($vm, $child($vm, null));
            $view->render();
        }
    }
}
