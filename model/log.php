<?php
    class Log{
        public function store($user, $type, $desc, $datetime, $model){
            require ('../config/connection.php');
            $input = "INSERT INTO logs(user, type, descr, date, model) VALUES ('$user', '$type', '$desc', '$datetime', '$model')";
            mysqli_query($db, $input);
        }

        public function index($rol){
            require ('../../config/connection.php');

            $queryR = $rol == 1 ? 'True' : 'usuario = ' . $_SESSION['user_id'];
            $input = "SELECT descr,date,model, CONCAT(ft_name, ' ', fi_lastname) as name_user, photo, type FROM logs INNER JOIN user ON user.id = logs.user WHERE $queryR ORDER BY logs.date DESC LIMIT 0, 10 ";

            $output = $db->query($input);
            return $output;
        }
        
    }
?> 