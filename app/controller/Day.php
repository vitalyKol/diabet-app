<?php

namespace app\controller;

use system\Adapter;



class Day
{

    private $data = [];
    private $day;

    public function __construct($user = null, $y = null, $m = null, $d = null)
    {
        $date = $y . '-' . $m . '-' . $d;
        $this->day = $date;

        $pdo = Adapter::get();
        $sth = $pdo->prepare("SELECT * FROM `sugar` WHERE `day` = ? ORDER BY timeEnter");
        $sth->execute(array($date));
        $this->data = $sth->fetchAll(\PDO::FETCH_ASSOC);

    }

    public function createTrs()
    {
        $result = "";
        if (empty($this->data)) {
            $result .= "<tr><td colspan='5'>This day has no records yet</td></tr>";
        } else {
            foreach ($this->data as $row) {
                $time = substr($row['timeEnter'], 0, 5);
                $result .= "<tr><td>$time</td>
                <td>{$row['insulin']}</td>
                <td>{$row['XE']}</td>
                <td>{$row['sugar_blood']}</td>
                <td>{$row['comments']}</td>
                <td class='text-center'><a href='recordShow.php?id=" . $row['id_sugar'] . "' class='btn btn-primary'><i class=\"fa fa-pencil\"></i></a>
                <a href='sugarHandler.php/delete?id=" . $row['id_sugar'] . "' class='btn btn-primary'><i class=\"fa fa-trash\"></i></a></td>
                </tr>";
            }
        }
        return $result;
    }

    public function showTrs()
    {
        echo $this->createTrs();
    }

    public function showFormAddSugar()
    {

    }

    public function addSugar()
    {
//        $query = sprintf("INSERT INTO sugar(day, timeEnter, sugar) VALUES()", $date);
//
//        $result = mysqli_query($this->link(), $query) or die(mysqli_error($this->link()));
    }

    public function addMealTime()
    {

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

        $dayObj = new Day('Ivan', $year,$month,$day);
        $this->view->dayObj = $dayObj;
        $this->view->thisDay = $thisDay;
    }
}