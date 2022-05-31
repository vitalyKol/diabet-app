<?php
include "layouts/header.php";
include_once "DayTable.php";

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
?>
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h1>This is 404 ERROR</h1>
        </div>
    </div>
</div>
