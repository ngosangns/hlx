<?php
require("BaseController.php");

class NotFoundController extends BaseController
{
    public function __construct()
    {
        $this->getNotFoundView();
    }
}
