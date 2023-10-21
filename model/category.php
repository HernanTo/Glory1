<?php
    class Category{
        public function store($name){
            require ('../config/connection.php');
            $input = "INSERT INTO category( category ) VALUES ('$name')";
            mysqli_query($db, $sql);

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó una nueva categoría', $date, 5);
        }

        public function index(){
            require ('../../config/connection.php');
            $input = "SELECT * FROM category";
            $output = $db->query($input);

            return $output;
        }
        
    }
?> 