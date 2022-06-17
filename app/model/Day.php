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
    public $bread_units;
    public $sugar_blood;
    public $comments;
    public $id_user;

    static public function getTable(){
        return 'sugar';
    }

    public function getDayRecords($day){
        $idUser = $_SESSION['id'];
        $pdo = Adapter::get();
        $table = self::getTable();
        $sql = "SELECT * FROM " . $table . " WHERE `day` = ? AND `id_user` = ? ORDER BY timeEnter";
        $query = $pdo->prepare($sql);
        $query->execute([$day, $_SESSION['id']]);
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        if(!$rows){
            return null;
        }

        $objs =[];

        foreach ($rows as $row){
            $objs[] = self::createClassObject($row);
        }
        return $objs;
    }

    public function insertRecord($post){

        $object = self::createClassObject($post);
        $object->id_user = $_SESSION['id']; //temporary solution
        $arrayFromObject = (array)$object;
        array_shift($arrayFromObject); // delete id_sugar

        $pdo = Adapter::get();
        $sth = $pdo->prepare("INSERT INTO `sugar` (day, timeEnter, insulin, bread_units, sugar_blood, comments, id_user) values (:day, :timeEnter, :insulin, :bread_units, :sugar_blood, :comments, :id_user)");
        $sth->execute($arrayFromObject);

    }

    public function deleteRecord($id){
        $pdo = Adapter::get();
        $sth = $pdo->prepare("DELETE FROM `sugar` WHERE `id_sugar` = :id");
        $sth->execute(array('id' => $id));
    }

    public function updateRecord(){
        $pdo = Adapter::get();

        if($_POST['insulin'] == ""){
            unset($_POST['insulin']);
        }
        if($_POST['bread_units'] == ""){
            unset($_POST['bread_units']);
        }

        $object = self::createClassObject($_POST);
        $object->id_user = $_SESSION['id']; //temporary solution
        $arrayFromObject = (array)$object;
        array_pop($arrayFromObject); // delete id_user

        $sth = $pdo->prepare("UPDATE `sugar` SET `day` = :day, `timeEnter` = :timeEnter, `insulin` = :insulin, `bread_units` = :bread_units, `sugar_blood` = :sugar_blood, `comments` = :comments WHERE `id_sugar` = :id_sugar");
        $sth->execute($arrayFromObject);
    }
}