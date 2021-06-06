<?php
namespace controllers;
require("BaseController.php");

class LoginController extends BaseController {
    private $viewPath = "views/LoginView.php";
    
    function __construct(String $path) {
        if($path === "/") {
            $this->getView(
                ["title" => "Đăng nhập"],
                $this->viewPath
            );
        }
    }
}
?>
