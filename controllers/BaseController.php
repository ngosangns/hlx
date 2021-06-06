<?php
namespace controllers;
require_once "models/ObjectViewModel.php"; use models\ObjectViewModel;

class BaseController {
    function getQueryObj() {
        // map queries to object
        $queries = array();
        parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queries);
        $queries = (object) $queries;
        return $queries;
    }

    function getView(array $array = [], String $viewPath) {
        $vm = new ObjectViewModel($array);
        require($viewPath);
    }
}
?>