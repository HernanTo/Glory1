<?php
    class Log{
        public function store($user, $type, $desc, $datetime, $model){
            require ('../config/connection.php');
            $input = "INSERT INTO logs(user, type, descr, date, model) VALUES ('$user', '$type', '$desc', '$datetime', '$model')";
            mysqli_query($db, $input);
        }

        public function index($rol){
            require ('../../config/connection.php');

            $queryR = $rol == 1 ? 'True' : 'logs.user = ' . $_SESSION['user_id'];
            if($rol == 4){
                $queryR = "role_id != 1";
            }

            $input = "SELECT descr,date,model, CONCAT(ft_name, ' ', fi_lastname) as name_user, photo, model, type FROM logs 
            INNER JOIN user ON user.id = logs.user 
            INNER JOIN user_has_role ON logs.user = user_id
            WHERE $queryR ORDER BY logs.date DESC LIMIT 0, 10";

            $output = $db->query($input);
            return $output;
        }

        public function indexM($rol){
            require ('../../config/connection.php');

            $queryR = $rol == 1 || $rol == 4 ? 'True' : 'logs.user = ' . $_SESSION['user_id'];
            if($rol == 4){
                $queryR = "role_id != 1";
            }
            $input = "SELECT descr, logs.id, date,model,photo, CONCAT(ft_name, ' ', fi_lastname) as name_user, cedula, photo, model, type FROM logs 
            INNER JOIN user ON user.id = logs.user 
            INNER JOIN user_has_role ON logs.user = user_id
            WHERE $queryR ORDER BY logs.date DESC";

            $output = $db->query($input);
            return $output;
        }
        
    }
?> 