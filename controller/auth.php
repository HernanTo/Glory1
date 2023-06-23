<?php
    session_start();
    require ('../model/auth.php');

    class authControlller{
        public function login(){
            $nickname = $_POST['nickname'];
            $password = $_POST['password'];
            $Auth = new Auth;
            $Auth->login($nickname, $password);
        }
    }

    $authControlller = new authControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $authControlller-> $fuct();

    }else{
        if(isset($_SESSION['login'])){
            if($_SESSION['login'] == 1){
                header('Location: ../views/dashboard/');
            }

        }else{
            header('Location: ../views/auth/login.php');
        }
    }
?>