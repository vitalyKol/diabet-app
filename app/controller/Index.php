<?php

namespace app\controller;

class Index
{
    public function index(){
        echo "!!!!!";
    }

    public function calendarShow(){
        echo "calendarShow";
        header("Location: /calendarshow.php");
    }

    public function dayShow(){
        echo "dayShow";
        header("Location: /dayshow.php");
    }

    public function error404(){
        echo "error";
        header("Location: /404.php");
    }
}