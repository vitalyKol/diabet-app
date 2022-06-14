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
        $validEmail = ModelAuth::emailValidation($_POST['email']);
        if($validEmail){
            $result = ModelAuth::isEmailExist($_POST['email']);
            if(!$result){
                $error['errorLogin'] = true;
                $error['errorEmail'] = $_POST['email'];
            }else{
                $error['errorLogin'] = null;
                $_SESSION['authorization'] = true;
                header('Location: /');
            }
        }else{
            $error['errorLogin'] = true;
            $error['errorEmail'] = $_POST['email'];
        }
        $this->view->action = 'index';
        $this->view->error = $error;
    }

    public function profileShow(){
        $this->view->user = ['name' => 'USER', 'email' => "MAIL"];
    }

    public function logout(){
        $_SESSION['authorization'] = null;
        header('Location: /');
    }

    public function register(){
        if($_POST){
            $resultValidation = ModelAuth::dataValidation($_POST);
            $errorFlag = false;
            foreach ($resultValidation as $elem){
                if(!$elem){
                    $errorFlag = true;
                    break;
                }
            }
            if($errorFlag){
                $this->view->errorValidation = $resultValidation;
            }
            else{
                ModelAuth::addUser($_POST);
                $_SESSION['authorization'] = true;
                header('Location: /');
            }

        }

    }
}