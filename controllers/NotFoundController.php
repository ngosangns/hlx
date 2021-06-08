<?php
require("BaseController.php");

class NotFoundController extends BaseController
{
    public function __construct()
    {
        echo "Not found - 404";
    }
}
