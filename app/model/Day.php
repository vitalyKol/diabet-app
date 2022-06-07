<?php

namespace app\model;

use system\Model;
use system\Adapter;

class Day extends Model
{
    public $id_sugar;
    public $day;
    public $timeEnter;
    public $insulin;
    public $XE;
    public $sugar_blood;
    public $comments;
    public $id_user;

    static public function getTable(){
        return 'sugar';
    }

    public function getDayData($day){
        $pdo = Adapter::get();
        $table = self::getTable();
        $sql = "SELECT * FROM " . $table . " WHERE `day` = ? ORDER BY timeEnter";
        $query = $pdo->prepare($sql);
        $query->execute([$day]);
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        if(!$rows){
            return null;
        }

        $objs =[];

        foreach ($rows as $row){
            $obj = new self();

            foreach($row as $field => $value){
                $obj->{$field} = $value;
            }

            $objs[] = $obj;
        }
        return $objs;
    }

    public function insertRecord($post){

        $day = $post['day'];
        $time = $post['sugarTime'];
        $sugar = $post['sugar'];
        $insulin = $post['sugarInsulin'];
        $BU = $post['sugarBU'];
        $comment = $post['sugarComment'];
        $user = 1; // temporary user ID

        $pdo = Adapter::get();
        $sth = $pdo->prepare("INSERT INTO `sugar` (day, timeEnter, insulin, XE, sugar_blood, comments, id_user) values (:day, :time, :insulin, :BU, :sugar, :comment, :user)");
        $sth->execute(array('day' => $day, 'time' => $time, 'insulin' => $insulin, 'BU' => $BU, 'sugar' => $sugar, 'comment' => $comment, 'user' => $user ));

    }

    public function deleteRecord($id){
        $pdo = Adapter::get();
        $sth = $pdo->prepare("DELETE FROM `sugar` WHERE `id_sugar` = :id");
        $sth->execute(array('id' => $id));
    }

    public function updateRecord(){
        $pdo = Adapter::get();
        if($_POST['sugarInsulin'] == ""){
            unset($_POST['sugarInsulin']);
        }
        if($_POST['sugarBU'] == ""){
            unset($_POST['sugarBU']);
        }
        $sth = $pdo->prepare("UPDATE `sugar` SET `timeEnter` = :time, `insulin` = :insulin, `XE` = :BU, `sugar_blood` = :sugar, `comments` = :comments WHERE `id_sugar` = :id");
        $sth->execute(array('time' => $_POST['sugarTime'], 'insulin' => $_POST['sugarInsulin'], 'BU' => $_POST['sugarBU'], 'sugar' => $_POST['sugar'], 'comments' => $_POST['sugarComment'], 'id' => $_POST['id']));
    }
}