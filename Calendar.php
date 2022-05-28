<?php

class Calendar
{
    private $time;
    private $nameDays = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб', 'Вс'];
    private $nameMonth = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь',];
    private $amountDaysInMonth;
    private $numberDay;
    private $firstDayWeek;
    private $currentMonth;
    private $currentYear;
    private $currentDay;

    private $htmlTable = '';

    public function __construct(){
        if(isset($_GET["month"])){
            $month =  date('n', time());
            if($month == $_GET["month"]){
                $this->time = time();
            }else {
                $this->time = mktime(0, 0, 0, $_GET["month"], 1, $this->currentYear);
            }
        }else {
            $this->time = time();
        }

        $this->amountDaysInMonth = date('t', $this->time);
        $this->currentMonth =  date('m', $this->time);
        $this->currentYear =  date('Y', $this->time);
        $this->currentDay =  date('d', $this->time);
        $this->firstDayWeek = date('w', mktime(0,0,0, $this->currentMonth, 1, $this->currentYear));
        if($this->firstDayWeek == 0){
            $this->firstDayWeek = 7;
        }
    }

    private function createCalendar(){
        $flag = true;
        $m = $this->currentMonth;
        $y = $this->currentYear;
        $this->htmlTable .= '<table class="table table-striped table-bordered text-center">';
        for($i = 0, $td = 1;;){
            $this->htmlTable .= '<tr>';

            if($i == 0){
                foreach ($this->nameDays as $day){
                    $this->htmlTable .= "<th>$day</th>";
                }
                $i++;
                continue;
            }
            for($j = 0; $j < 7; $j++, $td++) {
                if($i > $this->amountDaysInMonth){
                    $flag = false;
                    $this->htmlTable .= "<td></td>";
                    continue;
                }
                if($td < $this->firstDayWeek){
                    $this->htmlTable .= "<td></td>";
                }else{
                    if($i == $this->currentDay){
                        $this->htmlTable .= "<td class='p-0'><a href=\"dayshow.php?day=$i&month=$m&year=$y\" class='td-links td-active'>$i</a></td>";
                        $i++;
                        continue;
                    }
                    $this->htmlTable .= "<td class='p-0'><a href=\"dayshow.php?day=$i&month=$m&year=$y\" class='td-links'>$i</a></td>";
                    $i++;
                }
            }
            $this->htmlTable .= '</th>';
            if(!$flag){
                break;
            }
        }
        $this->htmlTable .= '</table>';
        return $this->htmlTable;
    }

    public function showMonth(){
        echo $this->nameMonth[$this->currentMonth-1];
    }

    public function showCalendar(){

        $result = $this->createCalendar();

        echo $result;
    }

    public function nextMonth(){
        $m = $this->currentMonth+1;
        echo "<a href=\"?month=$m\" class=\"btn btn-primary\">Next</a>";
    }
    public function lastMonth(){
        $m = $this->currentMonth-1;
        echo "<a href=\"?month=$m\" class=\"btn btn-primary\">Last</a>";
    }
}