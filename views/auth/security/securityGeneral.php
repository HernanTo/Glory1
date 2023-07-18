<?php
    session_start();
    if(isset($_SESSION['login'])){
        if(!$_SESSION['login'] == 1){
            header('Location: ../dashboard/');
        }
    }else{
        header('Location: ../auth/login.php');
    }
?>