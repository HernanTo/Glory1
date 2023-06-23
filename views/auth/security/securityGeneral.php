<?php
    session_start();
    if(isset($_SESSION['login'])){
        if(!$_SESSION['login'] == 1){
            header('Location: ../views/auth/login.php');
        }
    }else{
        header('Location: ../views/auth/login.php');
    }
?>