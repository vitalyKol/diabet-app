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

}