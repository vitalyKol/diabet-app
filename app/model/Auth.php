<?php

namespace app\model;

use system\Model;
use system\Adapter;

class Auth extends Model
{
    static public function getTable(){
        return 'users';
    }
    static public function checkEmail($post){
        $pdo = Adapter::get();
        $table = self::getTable();
        $sql = "SELECT `pass` FROM " . $table . " WHERE `email` = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$post['email']]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }
}