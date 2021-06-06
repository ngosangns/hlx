<?php

class ViewSetup {

    protected $field = array();
    
    function __construct($vm, $child = null, $template = null) {
        $this->vm = $vm;
        $this->child = $child;
        $this->template = $template;
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
    
    function render() {
        if($this->template !== null) {
            echo "Hi";
            $vm = $this->vm;
            $template = $this->template;
            $child = $this;
            require_once($template);
        } else {
            ($this->content)($this);
        }
    }
}
?>