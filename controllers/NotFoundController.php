<?php
namespace controllers;
require("BaseController.php");

class NotFoundController extends BaseController {
    function __construct() {
        echo "Not found - 404";
    }
}
?>