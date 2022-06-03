<?php

namespace app\controller;

require_once "Host.php";


class DayTable
{
    use Host;

    private $data = [];
    private $day;

    public function __construct($user, $y, $m, $d)
    {
        $date = $y . '-' . $m . '-' . $d;
        $this->day = $date;


//        self::connectionDB();
//        $sth = self::$dbh->prepare("SELECT * FROM `sugar` WHERE `day` = ? ORDER BY timeEnter");
//        $sth->execute(array($date));
//        $this->data = $sth->fetchAll(PDO::FETCH_ASSOC);

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
}