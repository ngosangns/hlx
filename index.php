<?php
namespace entry;
require("routers/MainRouter.php"); use routers\MainRouter;
require_once "views/setup/ViewSetup.php";

function entryPoint() {
    $path = isset($_GET['path']) ? $_GET['path'] : "";
    new MainRouter($path);
}

entryPoint();
?>