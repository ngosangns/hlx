<?php
require("BaseController.php");

class ProfileController extends BaseController
{
    private $viewPath = "views/templates/MainTemplate.php";

    public function __construct(String $path)
    {
        if ($path === "/") {
            $vm = new ObjectViewModel();
            $view = require $this->viewPath;
            $child = require "views/ProfileView.php";
            $view = $view($vm, $child($vm, null));
            $view->render();
        }
    }
}
