<?php
require("BaseController.php");

class ProfileController extends BaseController
{
    private $viewPath = "views/templates/MainTemplate.php";
    private $childPath = "views/ProfileView.php";

    public function __construct(String $path)
    {
        if ($path === "/") {
            $this->getInfoView();
        } elseif ($path === "/upload-manga") {
            $this->getUploadMangaView();
        } elseif ($path === "/upload-manga/add-manga") {
            $this->getAddMangaView();
        } elseif ($path === "/update-info") {
            $this->getUpdateInfoView();
        } else {
            $this->getNotFoundView();
        }
    }

    public function getInfoView()
    {
        $vm = new ObjectViewModel(["tab" => "info"]);
        $view = require $this->viewPath;
        $child = require $this->childPath;
        $child2 = require "views/ProfileView/InfoView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }

    public function getUploadMangaView()
    {
        $vm = new ObjectViewModel(["tab" => "upload-manga"]);
        $view = require $this->viewPath;
        $child = require $this->childPath;
        $child2 = require "views/ProfileView/UploadMangaView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }

    public function getUpdateInfoView()
    {
        $vm = new ObjectViewModel(["tab" => "update-info"]);
        $view = require $this->viewPath;
        $child = require $this->childPath;
        $child2 = require "views/ProfileView/UpdateInfoView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }

    public function getAddMangaView()
    {
        $vm = new ObjectViewModel(["tab" => "upload-manga"]);
        $view = require $this->viewPath;
        $child = require $this->childPath;
        $child2 = require "views/ProfileView/AddMangaView.php";
        $view = $view($vm, $child($vm, $child2($vm, null)));
        $view->render();
    }
}
