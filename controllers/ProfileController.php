<?php
require("BaseController.php");

class ProfileController extends BaseController
{
    private $viewPath = "views/templates/MainTemplate.php";

    public function __construct(String $path)
    {
        if ($path === "/") {
            $this->getInfoView();
        } elseif ($path == "/upload-manga") {
            $this->getUploadMangaView();
        } elseif ($path == "/update-info") {
            $this->getUpdateInfoView();
        }
    }

    public function getInfoView()
    {
        $vm = new ObjectViewModel(["tab" => "info"]);
        $view = require $this->viewPath;
        $child = require "views/ProfileView.php";
        $child2 = require "views/ProfileView/InfoView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }

    public function getUploadMangaView()
    {
        $vm = new ObjectViewModel(["tab" => "upload-manga"]);
        $view = require $this->viewPath;
        $child = require "views/ProfileView.php";
        $child2 = require "views/ProfileView/UploadMangaView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }

    public function getUpdateInfoView()
    {
        $vm = new ObjectViewModel(["tab" => "update-info"]);
        $view = require $this->viewPath;
        $child = require "views/ProfileView.php";
        $child2 = require "views/ProfileView/UpdateInfoView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }
}
