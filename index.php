<?php
namespace entry;
require("routers/MainRouter.php"); use routers\MainRouter;

function entryPoint() {
    $path = isset($_GET['path']) ? $_GET['path'] : "";
    new MainRouter($path);
}

entryPoint();
?>