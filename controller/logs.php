<?php
    session_start();
    require ('../model/log.php');

    class logControlller{
        public function index(){
            $Log = new Log;
            $Log->index();
        }
        public function store(){

        }

    }

    $logControlller = new logControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $logControlller-> $fuct();
    }
?>