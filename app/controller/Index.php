<?php

namespace app\controller;

use system\Controller;

class Index extends Controller
{
    public function index(){
//        echo "<pre>";
//        print_r($_SERVER);
//        echo "</pre>";
    }

    public function dayShow(){

        if(empty($_GET['year'])){
            $year = date('Y', time());
        }else{
            $year = $_GET['year'];
        }
        if(empty($_GET['month'])){
            $month = date('m', time());
        }else{
            $month = $_GET['month'];
        }
        if(empty($_GET['day'])){
            $day = date('d', time());
        }else{
            $day = $_GET['day'];
            if($day < 10){
                $day = '0' . $day;
            }
        }
        $thisDay = $year.'-'.$month.'-'.$day;;

        $dayObj = new DayTable('Ivan', $year,$month,$day);
        $this->view->dayObj = $dayObj;
        $this->view->thisDay = $thisDay;
    }

    public function error404(){

    }
}