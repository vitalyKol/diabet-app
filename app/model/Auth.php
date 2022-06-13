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
    static public function dataValidation($post){
        $pass = self::passValidation($post['pass']);
        $email = self::emailValidation($post['email']);
        $name = self::nameValidation($post['name']);
        $passRepeat = self::passRepeatValidation($post['pass'], $post['pass-repeat']);
        return ['name' => $name, 'pass' => $pass, 'email' => $email, 'passRepeat' => $passRepeat];
    }
    static public function passValidation($pass){
        if(!preg_match("/^[А-Яа-яA-Za-z0-9_-]{3,30}$/",$pass)) {
            return false;
        }
        return true;
    }
    static public function emailValidation($email){
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
    static public function nameValidation($name){
        if(!preg_match("/^[А-Яа-яA-Za-z0-9_-]{3,30}$/",$name)) {
            return false;
        }
        return true;
    }
    static public function passRepeatValidation($pass, $passRepeat){
        if($pass !== $passRepeat) {
            return false;
        }
        return true;
    }
}