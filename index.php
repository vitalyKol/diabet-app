<?php
error_reporting( E_ALL );

spl_autoload_register(function($name){
    $path = explode('\\', $name);
    $path = implode('/', $path); //change slash for linux
    $path .= '.php';
    require_once $path;
});

$router = new system\Router();
$route = $router->getRoute();

$view = new \system\View();
$view->controller = $route['controller'];
$view->action = $route['action'];

$controllerName = $route['controller'];
$controllerName = "app\\controller\\" . $controllerName;
$actionName = $route['action'];

$controller = new $controllerName();
$controller->view = $view;
$controller->params = $route['params'];
$controller->{$actionName}();


$view->renderLayout();