<?php
require_once "models/ObjectViewModel.php";

class BaseController
{
    public function getQueryObj()
    {
        // map queries to object
        $queries = array();
        parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queries);
        $queries = (object) $queries;
        return $queries;
    }

    public static function getNotFoundView()
    {
        echo "Not found - 404";
    }
}
