<?php

namespace system;

abstract class Model
{
    static public function getTable(){
        return false;
    }

    static public function find($id){
        $pdo = Adapter::get();
        $table = static::getTable();

        $sql = 'SELECT * FROM ' . $table . ' WHERE `id_sugar` = ?';
        $query = $pdo->prepare($sql);
        $query->execute([$id]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);

        if(!$row){
            return null;
        }
        return self::createClassObjet($row);
    }

    static public function findAll(){
        $pdo = Adapter::get();
        $table = static::getTable();

        $sql = 'SELECT * FROM ' . $table;
        $query = $pdo->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll(\PDO::FETCH_ASSOC);

        if(!$rows){
            return null;
        }
        $objs =[];

        foreach ($rows as $row){
            $objs[] = self::createClassObjet($row);
        }
        return $objs;
    }

    static protected function createClassObjet($row){
        $obj = new static(); //create an object of the class in which the function is called

        foreach($row as $field => $value){
            $obj->{$field} = $value;
        }

        return $obj;
    }
}