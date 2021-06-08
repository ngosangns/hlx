<?php
class ObjectModel
{
    protected $field = array();

    public function __construct(array $arrayObj = null)
    {
        if ($arrayObj != null) {
            $this->field = $arrayObj;
        }
    }

    public function __get($name)
    {
        if (isset($this->field[$name])) {
            return $this->field[$name];
        } else {
            return null;
        }
    }

    public function __set($name, $value)
    {
        $this->field[$name] = $value;
    }
}
