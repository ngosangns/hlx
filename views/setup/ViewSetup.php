<?php

class ViewSetup
{
    public $vm;
    private ViewSetup | null $child;
    private $head;
    private $content;
    private $foot;

    public function __construct($vm, ViewSetup | null $child)
    {
        $this->vm = $vm;
        $this->child = $child;
    }

    public function getHead()
    {
        if (isset($this->head)) {
            ($this->head)($this);
        } else {
            return function () {
            };
        }
    }

    public function getContent()
    {
        if (isset($this->content)) {
            ($this->content)($this);
        } else {
            return function () {
            };
        }
    }

    public function getFoot()
    {
        if (isset($this->foot)) {
            ($this->foot)($this);
        } else {
            return function () {
            };
        }
    }

    public function setHead($func)
    {
        $this->head = $func;
    }

    public function setContent($func)
    {
        $this->content = $func;
    }

    public function setFoot($func)
    {
        $this->foot = $func;
    }

    public function getChild()
    {
        if ($this->child != null) {
            return $this->child;
        } else {
            return new ViewSetup($this->vm, null);
        }
    }

    public function render()
    {
        $this->getHead();
        $this->getContent();
        $this->getFoot();
    }
}
