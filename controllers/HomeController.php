<?php
namespace controllers;
require("BaseController.php");

class HomeController extends BaseController {
    private $viewPath = "views/HomeView.php";
    
    function __construct(String $path) {
        if($path === "/") {
            $this->getView(
                [],
                $this->viewPath
            );
        }
    }
}
?>