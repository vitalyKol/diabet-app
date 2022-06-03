<?php

namespace app\controller;
trait Host
{
    private static $host = 'localhost'; // имя хоста
    private static $user = 'root';      // имя пользователя
    private static $pass = '';          // пароль
    private static $name = 'sugar';      // имя базы данных
    private static $dbh;

    private static function link()
    {
        return mysqli_connect(self::$host, self::$user, self::$pass, self::$name);
    }

    public static function connectionDB()
    {
//        try {
//            self::$dbh = new PDO('mysql:dbname=sugar;host=localhost', self::$user, self::$pass);
//        } catch (PDOException $e) {
//            die($e->getMessage());
//        }
    }

}

