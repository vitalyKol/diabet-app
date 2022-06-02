<?php
error_reporting( E_ALL );
//header("Location: /calendarshow.php");

spl_autoload_register(function($name){
    $path = explode('\\', $name);
    $path = implode('/', $path);
    $path .= '.php';
    require_once $path;
});

$router = new system\Router();
$route = $router->getRoute();

$conname = $route['controller'];
$conname = "app\\controller\\" . $conname;
$actname = $route['action'];

$controller = new $conname();
$controller->{$actname}();
