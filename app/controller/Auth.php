<?php

namespace app\controller;

use system\Controller;
use app\model\Auth as ModelAuth;

class Auth extends Controller
{
    public function index(){
    }

    public function login(){
        $validEmail = ModelAuth::validateEmail($_POST['email']);
        if($validEmail){
            $result = ModelAuth::isEmailExist($_POST['email']);
            if(!$result){
                $error['errorLogin'] = true;
                $error['errorEmail'] = $_POST['email'];
            }else{
                $row = ModelAuth::getUser($_POST['email']);
                if(password_verify($_POST['pass'], $row['pass'])){
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $error['errorLogin'] = null;
                    $_SESSION['authorization'] = true;
                    header('Location: /');
                }else{
                    $error['errorLogin'] = true;
                    $error['errorEmail'] = $_POST['email'];
                }
            }
        }else{
            $error['errorLogin'] = true;
            $error['errorEmail'] = $_POST['email'];
        }
        $this->view->action = 'index';
        $this->view->error = $error;
    }

    public function profileShow(){

        //For graph
        $statics = ModelAuth::getStaticsFor30Days();
        $statics = array_reverse($statics);
        $max = max($statics);
        for($i = 0; $i < 30; $i++){
            $averageDaySugar[$i] = round($statics[$i]/$max,2); //blood sugar in range from 0 to 1 for graph
        }
        $htmlCode = '';
        for($i = 0, $j = 1; $i < 29; $i++, $j++){
            $htmlCode .= "<tr><td style=\"--start: $averageDaySugar[$i]; --size:  $averageDaySugar[$j]\"> <span class=\"data\"> $statics[$j] </span> </td></tr>";
        }
        $this->view->htmlCode = $htmlCode;


        $averageSugarForAllTime = ModelAuth::getAverageSugarForAllTime();
        $this->view->averageSugarForAllTime = $averageSugarForAllTime;


        $row = ModelAuth::getUser($_SESSION['email']);
        $this->view->user = ['name' => $row['login'], 'email' => $row['email']];
    }

    public function logout(){
        $_SESSION['authorization'] = null;
        $_SESSION['id'] = null;
        $_SESSION['email'] = null;
        header('Location: /');
    }

    public function register(){
        if($_POST){
            $resultValidation = ModelAuth::dataValidationForRegister($_POST);
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
                $row = ModelAuth::getUser($_POST['email']);
                $_SESSION['id'] = $row['id'];
                $_SESSION['authorization'] = true;
                header('Location: /');
            }

        }

    }
    public function showChangePasswordPage(){
        $errorPass = null;
        if(isset($_POST['new-pass'])){
            foreach ($_POST as $post){
                if(!ModelAuth::validatePassword($post)){
                    $errorPass = 'incorrect';
                    break;
                }
            }
            if($errorPass !== 'incorrect'){
                if(!ModelAuth::validateRepeatPassword($_POST['new-pass'], $_POST['new-repeat-pass'])){
                    $errorPass = 'notEqual';
                }else{
                    $row = ModelAuth::getUser($_SESSION['email']);
                    if(password_verify($_POST['old-pass'], $row['pass'])){
                        $errorPass = 'noErrors';
                        ModelAuth::updatePassword($_POST['new-pass']);
                    }else{
                        $errorPass = 'oldPassWrong';
                    }
                }
            }
        }

        $this->view->errorPass = $errorPass;
    }


}