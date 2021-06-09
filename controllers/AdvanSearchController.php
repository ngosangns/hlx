<?php
require("BaseController.php");

class AdvanSearchController extends BaseController
{
    private $viewPath = "views/templates/MainTemplate.php";

    public function __construct(String $path)
    {
        if ($path === "/") {
            $vm = new ObjectViewModel(["title" => "Tìm kiếm nâng cao"]);
            $view = require $this->viewPath;
            $child = require "views/AdvanSearchView.php";
            $view = $view($vm, $child($vm, null));
            $view->render();
        }
    }
}
