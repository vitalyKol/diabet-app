<?php

namespace system;

class Router
{
    private $routes = [];

    public function __construct(){
        include "app/config/routes.php";
    }

    private function addRoute($url, $controller, $action){
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
        $uri = explode('?', $uri);
        $uri = $uri[0];

        $flag = false;
        foreach ($this->routes as $rurl => $route){
            $preg = '|^' . $rurl . '$|';
            if(preg_match($preg, $uri, $matches)){
                $flag = true;
                break;
            }
        }
        if(!$flag){
            $route = [
                'controller' => 'Index',
                'action' => 'error404'
            ];
        }

        $matches = array_splice($matches, 1);

        $route['params'] = $matches;
        return $route;
    }
}