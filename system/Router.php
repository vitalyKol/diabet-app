<?php

namespace system;

class Router
{
    public $routes = [];

    public function __construct(){
        include_once "app/config/routes.php";
    }
    public function addRoute($url, $controller, $action){
        $req = [
            'controller' => $controller,
            'action' => $action
        ];

        $this->routes[$url] = $req;
    }

    public function getRoute(){
        $phpself = $_SERVER["PHP_SELF"];
        $phpself = substr($phpself, 0, -9);

        $dirlength = strlen($phpself);
        $uri = $_SERVER["REQUEST_URI"];
        $uri = substr($uri, $dirlength);
    }
}