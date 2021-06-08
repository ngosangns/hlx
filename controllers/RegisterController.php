<?php
require("BaseController.php");

class RegisterController extends BaseController
{
    private $viewPath = "views/templates/LoginTemplate.php";
    
    public function __construct(String $path)
    {
        if ($path === "/") {
            $vm = new ObjectViewModel(["title" => "Đăng ký"]);
            $view = require $this->viewPath;
            $child = require "views/RegisterView.php";
            $view = $view($vm, $child($vm, null));
            $view->render();
        }
    }
}
