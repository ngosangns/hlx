<?php

namespace models;

class ObjectModel {
    protected $field = array();

    function __construct(array $arrayObj = null) {
        if($arrayObj != null) {
            $this->field = $arrayObj;
        }
    }

    function __get($name) {
        if (isset($this->field[$name]))
            return $this->field[$name];
        else
            return null;
    }

    function __set($name, $value) {
        $this->field[$name] = $value;
    }
}
