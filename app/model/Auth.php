<?php

namespace app\model;

use system\Model;
use system\Adapter;

class Auth extends Model
{
    static public function getTable(){
        return 'users';
    }
    static public function isEmailExist($email){
        $pdo = Adapter::get();
        $table = self::getTable();
        $sql = "SELECT `email` FROM " . $table . " WHERE `email` = ?";
        $query = $pdo->prepare($sql);
        $query->execute([$email]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        if(empty($row)){
            return false;
        }
        return true;
    }
    static public function dataValidation($post){
        $pass = self::passValidation($post['pass']);
        $emailIncorrect = self::emailValidation($post['email']);
        if($emailIncorrect){
            $emailExist = self::isEmailExist($post['email']);
        }else{
            $emailExist = false;
        }
        $name = self::nameValidation($post['name']);
        $passRepeat = self::passRepeatValidation($post['pass'], $post['pass-repeat']);
        return ['name' => $name, 'pass' => $pass, 'emailIncorrect' => $emailIncorrect, 'emailExist' => !$emailExist, 'passRepeat' => $passRepeat];
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
    static function addUser($data){
        array_pop($data); // delete pass-repeat
        $pdo = Adapter::get();
        $table = self::getTable();
        $sql = "INSERT INTO ". $table ." (login, pass, email) values (:name, :pass, :email)";
        $query = $pdo->prepare($sql);
        $query->execute($data);
    }
}