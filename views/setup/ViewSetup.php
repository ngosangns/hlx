<?php

class ViewSetup {

    protected $field = array();
    
    function __construct($vm) {
        $this->vm = $vm;
    }
    
    function __get($name) {
        if (isset($this->field[$name]))
            return $this->field[$name];
        else
            return function() {
                
            };
    }

    function __set($name, $value) {
        $this->field[$name] = $value;
    }
}
?>