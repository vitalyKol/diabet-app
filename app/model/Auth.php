<?php

namespace app\model;

use system\Model;
use system\Adapter;

class Auth extends Model
{
    public $id;
    public $login;
    public $pass;
    public $email;
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
    static public function dataValidationForRegister($post){
        $errorPassBool = self::validatePassword($post['pass']);
        $errorEmailBool = self::validateEmail($post['email']);
        if($errorEmailBool){
            $errorEmailExistBool = self::isEmailExist($post['email']);
        }else{
            $errorEmailExistBool = false;
        }
        $errorNameBool = self::validateName($post['name']);
        $errorPassRepeatBool = self::validateRepeatPassword($post['pass'], $post['pass-repeat']);
        return ['name' => $errorNameBool, 'pass' => $errorPassBool, 'emailIncorrect' => $errorEmailBool, 'emailExist' => !$errorEmailExistBool, 'passRepeat' => $errorPassRepeatBool];
    }
    static public function validatePassword($password){
        if(preg_match("/^[А-Яа-яA-Za-z0-9_-]{3,30}$/",$password)) {
            return true;
        }
        return false;
    }
    static public function validateEmail($email){
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }
    static public function validateName($name){
        if(preg_match("/^[А-Яа-яA-Za-z0-9_-]{3,30}$/",$name)) {
            return true;
        }
        return false;
    }
    static public function validateRepeatPassword($password, $passwordRepeat){
        if($password === $passwordRepeat) {
            return true;
        }
        return false;
    }

    static function addUser($data){
        array_pop($data); // delete pass-repeat
        $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO `users` (login, pass, email) values (:name, :pass, :email)";
        $query = self::executePrepareQuery($sql, $data);
    }
    static function getUser($email)
    {
        $sql = "SELECT * FROM `users` WHERE `email` = ?";
        $query = self::executePrepareQuery($sql, [$email]);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }
    static function updatePassword($password){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE `users` SET pass = ? WHERE `id` = ?";
        $query = self::executePrepareQuery($sql, [$password, $_SESSION['id']]);

    }
    static public function getStaticsFor30Days(){
        $last30Days = self::getLast30Dates();
        $averageDaySugar = [];
        for($i = 0; $i < 30; $i++){
            $AVGSugar = self::getAverageSugarForDay($last30Days[$i]);
            $averageDaySugar[] =  round($AVGSugar['averageSugarForDay'], 2) ?? '0';
        }
        return $averageDaySugar;
    }
    static public function getAverageSugarForDay($day){
        $needData = ['user' => $_SESSION['id'], 'day' => $day];
        $sql = "SELECT AVG(`sugar_blood`) as `averageSugarForDay` FROM `sugar` WHERE `id_user` = :user AND `day` = :day";
        $query = self::executePrepareQuery($sql, $needData);

        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }
    static public function getLast30Dates(){
        $today = time();
        $last30Days = [];
        for($i = 0; $i < 30; $i++){
            $last30Days[] = date('Y-m-d', $today-(86400*$i));
        }
        return $last30Days;
    }

    static public function getAverageSugarForAllTime(){
        $needData = ['user' => $_SESSION['id']];
        $sql = "SELECT AVG(`sugar_blood`) as `averageSugarForAllTime` FROM `sugar` WHERE `id_user` = :user";
        $query = self::executePrepareQuery($sql, $needData);
        $row = $query->fetch(\PDO::FETCH_ASSOC);
        return $row;
    }
}