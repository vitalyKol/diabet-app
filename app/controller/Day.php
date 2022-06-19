<?php

namespace app\controller;

use system\Controller;
use \app\model\Day as ModalDay;

class Day extends Controller
{

    public $days = [];
    public $thisDay;

    public function __construct($day = null)
    {

        $this->thisDay = $day;
        $dayData = new ModalDay;
        if(isset($this->thisDay)){
            $this->days = $dayData->getDayRecords($this->thisDay);
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
        $dayData = new ModalDay;
        $dayData->insertRecord($_POST);
        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public function deleteSugarRecord(){
        $dayData = new ModalDay;
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
        $dayData = new ModalDay;
        $obj = $dayData::find($id);
        $this->view->dayObj = $obj;
    }

    public function updateSugarRecord(){
        $dayData = new ModalDay;

        $dayData->updateRecord();

        header("Location: http://$_SERVER[SERVER_NAME]/day/$_POST[day]");
    }

    public function nextDay(){
        $today = strtotime($this->thisDay);
        $d = date('Y-m-d',  $today + 86400); //86400 - amount of seconds in day
        return $d;
    }
    public function lastDay(){
        $today = strtotime($this->thisDay);
        $d = date('Y-m-d', $today - 86400);
        return $d;
    }
}