<?php
    class Role{
        public function index(){
            require ('../../config/connection.php');
            $input = "SELECT * FROM role";
            $output = $db->query($input);

            return $output;
        }
        
    }
?> 