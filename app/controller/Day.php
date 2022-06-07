<?php

namespace app\controller;

use system\Controller;
use \app\model\Day as modalDay;

class Day extends Controller
{

    public $days = [];
    public $thisDay;

    public function __construct($day = null)
    {

        $this->thisDay = $day;
        $dayData = new modalDay;
        if(isset($this->thisDay)){
            $this->days = $dayData->getDayData($this->thisDay);
        }

    }

    public function getDay(){
        return date('Y-m-d', time());
    }

    public function dayShow(){
        if(isset($this->params[0])){
            $day = $this->params[0];
        }else{
            $day = $this->getDay();
        }

        $dayObj = new Day($day);
        $this->view->dayObj = $dayObj;
    }
}