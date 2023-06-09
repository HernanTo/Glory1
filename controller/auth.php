<?php
    session_start();

    class auth{
        public function login(){
            
        }
    }

    $auth = new auth;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $auth-> $fuct();
    }else{
        if(isset($_SESSION['login'])){
            if($_SESSION['login'] == 1){
                header('Location: ../views/index.php');
            }
        }else{
            header('Location: ../views/auth/login.php');
        }
    }
?>