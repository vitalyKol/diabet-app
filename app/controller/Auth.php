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
            $errorLogin = true;

        }else{
            $errorLogin = null;
            $_SESSION['authorization'] = true;
            header('Location: /profile');
        }
        $this->view->action = 'index';
        $this->view->errorLogin = $errorLogin;
    }

    public function profileShow(){
        $this->view->user = ['name' => 'USER', 'email' => "MAIL"];
    }

    public function logout(){
        $_SESSION['authorization'] = null;
        header('Location: /');
    }

    public function register(){

    }
}