<?php
error_reporting( E_ALL );
//header("Location: /calendarshow.php");

spl_autoload_register(function($name){
    $path = explode('\\', $name);
    $path = implode('/', $path);
    $path .= '.php';
    require_once $path;
});

$phpself = $_SERVER["PHP_SELF"];
$phpself = substr($phpself, 0, -9);

$dirlength = strlen($phpself);
$uri = $_SERVER["REQUEST_URI"];
$uri = substr($uri, $dirlength);



$pages = [
    "" => "calendarshow.php",
    "calendar" => "calendarshow.php",
    "day" => "dayshow.php"
         ];

//if(isset($pages[$uri])){
//    require $pages[$uri];
//}else{
//    require '404.php';
//}
if(isset($pages[$uri])){
    header("Location: /$pages[$uri]");
}else{
    header("Location: /404.php");
}