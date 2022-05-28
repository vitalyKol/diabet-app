<?php
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


if(!isset($_POST)){
    header("Location: $_SERVER[HTTP_REFERER]");
}
$action = trim(strrchr($_SERVER['REQUEST_URI'], '/'), '/');
require_once "Host.php";

class SugarHandler{
    use Host;
    public static function insertRecord($post){

        $day = $post['day'];
        $time = $post['sugarTime'];
        $sugar = $post['sugar'];
        $insulin = $post['sugarInsulin'];
        $BU = $post['sugarBU'];
        $comment = $post['sugarComment'];
        $user = 1; // temporary user ID

        self::connectionDB();
        $sth = self::$dbh->prepare("INSERT INTO `sugar` (day, timeEnter, insulin, XE, sugar_blood, comments, id_user) values (:day, :time, :insulin, :BU, :sugar, :comment, :user)");
        $sth->execute(array('day' => $day, 'time' => $time, 'insulin' => $insulin, 'BU' => $BU, 'sugar' => $sugar, 'comment' => $comment, 'user' => $user ));

        header("Location: $_SERVER[HTTP_REFERER]");
    }

    public static function updateRecord(){
        self::connectionDB();
        print_r($_POST);
        if($_POST['sugarInsulin'] == ""){
            unset($_POST['sugarInsulin']);
        }
        if($_POST['sugarBU'] == ""){
            unset($_POST['sugarBU']);
        }
        $sth = self::$dbh->prepare("UPDATE `sugar` SET `timeEnter` = :time, `insulin` = :insulin, `XE` = :BU, `sugar_blood` = :sugar, `comments` = :comments WHERE `id_sugar` = :id");
        $sth->execute(array('time' => $_POST['sugarTime'], 'insulin' => $_POST['sugarInsulin'], 'BU' => $_POST['sugarBU'], 'sugar' => $_POST['sugar'], 'comments' => $_POST['sugarComment'], 'id' => $_POST['id']));
        $day = explode('-', $_POST['day']);

        header("Location: http://$_SERVER[SERVER_NAME]/dayshow.php?day=$day[2]&month=$day[1]&year=$day[0]");
    }

    public static function selectRecord($id){
        self::connectionDB();
        $sth = self::$dbh->prepare("SELECT * FROM `sugar` WHERE `id_sugar` = :id");
        $sth->execute(array('id' => $id));
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        $time = substr($row['timeEnter'], 0, 5);

        return $row;
    }


    public static function deleteRecord($id){
        self::connectionDB();
        $sth = self::$dbh->prepare("DELETE FROM `sugar` WHERE `id_sugar` = :id");
        $sth->execute(array('id' => $id));

        header("Location: $_SERVER[HTTP_REFERER]");
    }
}

//SugarHandler::insertRecord($_POST);

if($action == 'insert'){
    SugarHandler::insertRecord($_POST);
}elseif($action == 'update'){
    SugarHandler::updateRecord();
}else{
    preg_match("#.+\?#", $action, $str);
    $str = trim($str[0], '?');

    if($str == 'update'){
        if(!isset($_GET['id'])){
            header("Location: ../404.php");
        }
        SugarHandler::updateRecord($_GET['id']);
    }elseif($str == 'delete'){
        if(!isset($_GET['id'])){
            header("Location: ../404.php");
        }
        SugarHandler::deleteRecord($_GET['id']);
    }
}