<?php

namespace system;

class Adapter
{
    static private $_instance = null;

    private function __construct(){} //prohibit cloning and creation new object
    private function __clone(){}

    static private function getInstance(){
        $config = include 'app/config/db.php';
        $pdo = new \PDO(
            'mysql:host=' . $config['host'] . ';dbname=' . $config['dbname'],
            $config['user'],
            $config['pass']
        );
        return $pdo;
    }

    static public function get(){
        if(!self::$_instance){
            self::$_instance = self::getInstance();
        }
        return self::$_instance;
    }
}