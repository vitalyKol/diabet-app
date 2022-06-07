<?php

namespace app\controller;
use system\Controller;

class Calendar extends Controller
{
    private $time;
    private $nameDays = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
    private $nameMonth = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December',];
    private $amountDaysInMonth;
    private $firstDayWeek;
    private $currentMonth;
    private $currentYear;
    private $currentDay;

    private $htmlTable = '';

    public function __construct($monthGet = null)
    {
        if (isset($monthGet)) {
            $month = date('n', time());
            if ($month == $monthGet) {
                $this->time = time();
            } else {
                $this->time = mktime(0, 0, 0, $monthGet, 1, $this->currentYear);
            }
        } else {
            $this->time = time();
        }

        $this->amountDaysInMonth = date('t', $this->time);
        $this->currentMonth = date('m', $this->time);
        $this->currentYear = date('Y', $this->time);
        $this->currentDay = date('d', $this->time);
        $this->firstDayWeek = date('w', mktime(0, 0, 0, $this->currentMonth, 1, $this->currentYear));
        if ($this->firstDayWeek == 0) {
            $this->firstDayWeek = 7;
        }
    }

    private function createCalendar()
    {
        $flag = true;
        $m = $this->currentMonth;
        $y = $this->currentYear;
        for ($i = 0, $td = 1; ;) {
            $this->htmlTable .= '<tr>';

            if ($i == 0) {
                foreach ($this->nameDays as $day) {
                    $this->htmlTable .= "<th>$day</th>";
                }
                $i++;
                continue;
            }
            for ($j = 0; $j < 7; $j++, $td++) {
                if ($i > $this->amountDaysInMonth) {
                    $flag = false;
                    $this->htmlTable .= "<td></td>";
                    continue;
                }
                if ($td < $this->firstDayWeek) {
                    $this->htmlTable .= "<td></td>";
                } else {
                    if($i < 10){
                        $d = "0" . $i;
                    }else{
                        $d = $i;
                    }
                    if ($i == $this->currentDay) {
                        $this->htmlTable .= "<td class='p-0'><a href=\"..\day\\$y-$m-$d\" class='td-links td-active'>$i</a></td>";
                        $i++;
                        continue;
                    }
                    $this->htmlTable .= "<td class='p-0'><a href=\"..\day\\$y-$m-$d\" class='td-links'>$i</a></td>";
                    $i++;
                }
            }
            $this->htmlTable .= '</th>';
            if (!$flag) {
                break;
            }
        }
        return $this->htmlTable;
    }

    public function showMonth()
    {
        return $this->nameMonth[$this->currentMonth - 1];
    }

    public function showCalendar()
    {

        $result = $this->createCalendar();

        echo $result;
    }

    public function nextMonth()
    {
        $m = $this->currentMonth + 1;
        return $m;
    }

    public function lastMonth()
    {
        $m = $this->currentMonth - 1;
        return $m;
    }

    public function calendarShow(){
        if(isset($this->params[0])){
            $month = $this->params[0];

        }else{
            $month = date('n', time());
        }
        $this->view->calendar = new Calendar($month);
    }
}