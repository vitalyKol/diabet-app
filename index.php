<?php
error_reporting( E_ALL );

spl_autoload_register(function($name){
    $path = explode('\\', $name);
    $path = implode('/', $path);
    $path .= '.php';
    require_once $path;
});

$router = new system\Router();
$route = $router->getRoute();

$view = new \system\View();
$view->controller = $route['controller'];
$view->action = $route['action'];

$conname = $route['controller'];
$conname = "app\\controller\\" . $conname;
$actname = $route['action'];

$controller = new $conname();
$controller->view = $view;
$controller->params = $route['params'];
$controller->{$actname}();


$view->renderLayout();