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

    public function addSugarRecord(){
        $dayData = new modalDay;
        $dayData->insertRecord($_POST);
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public function deleteSugarRecord(){
        $dayData = new modalDay;
        $id = (int)$_GET['id'];
        if(is_int($id)){
            $dayData->deleteRecord($id);
        }
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public function showSugarRecord(){
        if(isset($this->params[0])){
            $id = $this->params[0];
        }
        $dayData = new modalDay;
        $obj = $dayData::find($id);
        $this->view->dayObj = $obj;
    }

    public function updateSugarRecord(){
        $dayData = new modalDay;

        $dayData->updateRecord();

        header("Location: http://$_SERVER[SERVER_NAME]/day/$_POST[day]");
    }
}