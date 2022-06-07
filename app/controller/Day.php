<?php

namespace app\controller;

use system\Controller;
use \app\model\Day as modalDay;

class Day extends Controller
{

    public $days = [];
    public $thisDay;

    public function __construct($user = null)
    {
        $dayData = new modalDay;
        $dayArr = $this->getDay();
        extract($dayArr);
        $this->thisDay = $year.'-'.$month.'-'.$day;;
        $this->days = $dayData->getDayData($this->thisDay);

    }

    public function getDay(){
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
        return ['year' => $year, 'month' => $month, 'day' => $day];
    }

    public function dayShow(){
        $dayObj = new Day('user');
        $this->view->dayObj = $dayObj;
    }
}