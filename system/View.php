<?php

namespace system;

class View
{
    public $controller;
    public $action;
    public $layout = 'default';
    private $data = [];

    public function render(){
        extract($this->data);
        include "app/views/" . $this->controller . "/" . $this->action . ".phtml";
    }

    public function renderLayout(){
        extract($this->data);
        include "app/layouts/" . $this->layout . ".phtml";
    }

    public function __set($name, $value){
        $this->data[$name] =  $value;
    }
}