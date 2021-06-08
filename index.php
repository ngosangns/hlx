<?php
require("routers/MainRouter.php");

require_once "views/setup/ViewSetup.php";

function entryPoint()
{
    $path = isset($_GET['path']) ? $_GET['path'] : "";
    new MainRouter($path);
}

entryPoint();
