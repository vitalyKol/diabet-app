<?php

namespace system;

abstract class Model
{
    static public function getTable(){
        return false;
    }

    static protected function executePrepareQuery($sql, $arrayParams){
        $pdo = Adapter::get();
        $query = $pdo->prepare($sql);
        $query->execute($arrayParams);
        return $query;
    }

    static public function find($id){
        $table = static::getTable();
        $sql = 'SELECT * FROM ' . $table . ' WHERE `id_sugar` = ?';
        $query = self::executePrepareQuery($sql, [$id]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$row){
            return null;
        }
        return self::createClassObject($row);
    }

    static public function findAll(){
        $table = static::getTable();
        $sql = 'SELECT * FROM ' . $table;
        $query = self::executePrepareQuery($sql, []);
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

    static protected function createClassObject($row){
        $obj = new static(); //create an object of the class in which the function is called

        foreach($row as $field => $value){
            $obj->{$field} = $value;
        }

        return $obj;
    }
}