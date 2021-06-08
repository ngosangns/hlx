<?php
require("BaseController.php");

class LoginController extends BaseController
{
    private $viewPath = "views/templates/LoginTemplate.php";
    
    public function __construct(String $path)
    {
        if ($path === "/") {
            $vm = new ObjectViewModel(["title" => "Đăng nhập"]);
            $view = require $this->viewPath;
            $child = require "views/LoginView.php";
            $view = $view($vm, $child($vm, null));
            $view->render();
        }
    }
}
