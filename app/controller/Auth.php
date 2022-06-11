<?php

namespace app\controller;

use http\Header;
use system\Controller;
use app\model\Auth as ModelAuth;

class Auth extends Controller
{
    public function index(){

    }

    public function login(){

        $result = ModelAuth::checkEmail($_POST);
        if(empty($result)){
            $result = "It's wrong email, please, try again";
        }else{
            $_SESSION['authorization'] = true;
        }
        $this->view->result = $result;
    }

    public function profileShow(){
        $this->view->user = ['name' => 'USER', 'email' => "MAIL"];
    }

    public function logout(){
        $_SESSION['authorization'] = null;
        header('Location: /');
    }
}