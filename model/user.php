<?php
    class User{
        public function store($ft_name, $sd_name, $ft_lastname, $st_lastname, $cedula, $address, $email, $phone, $role){
            require ('../config/connection.php');
            
            $nickname = generatorNicknames($ft_name, $ft_lastname);
            $password = password_hash($cedula, PASSWORD_DEFAULT);
            
            $input = "INSERT INTO user(cedula, ft_name, sd_name, fi_lastname, sc_lastname, nickname, password, phone, address, email, photo) VALUES ($cedula,'$ft_name','$sd_name','$ft_lastname','$st_lastname','$nickname','$password',$phone,'$address','$email','../../assets/img/profilePictures/default.png')";
            echo $input;
            
            mysqli_query($db, $input);
            $user = mysqli_insert_id($db);
            
            $input = "INSERT INTO user_has_role(user_id, role_id, state) VALUES ('$user','$role',1)";
            mysqli_query($db, $input);
            
            $_SESSION['user-add'] = true;
            
            header('Location: ../views/user/');
        }

        public function storebill($ft_name, $sd_name, $ft_lastname, $st_lastname, $cedula, $address, $email, $phone, $role){
            require ('../config/connection.php');
            
            $nickname = generatorNicknames($ft_name, $ft_lastname);
            $password = password_hash($cedula, PASSWORD_DEFAULT);
            
            $input = "INSERT INTO user(cedula, ft_name, sd_name, fi_lastname, sc_lastname, nickname, password, phone, address, email, photo) VALUES ($cedula,'$ft_name','$sd_name','$ft_lastname','$st_lastname','$nickname','$password',$phone,'$address','$email','../../assets/img/profilePictures/default.png')";
            echo $input;
            
            mysqli_query($db, $input);
            $user = mysqli_insert_id($db);
            
            $input = "INSERT INTO user_has_role(user_id, role_id, state) VALUES ('$user','$role',1)";
            mysqli_query($db, $input);
            
            $_SESSION['user-add'] = true;
            
            header('Location: ../views/bill/add-bill.php');
        }
        
        public function index(){
            require ('../../config/connection.php');

            $input = "SELECT id, cedula, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) AS nombres, nickname, phone, address, email, photo, role_id FROM user
            INNER JOIN user_has_role
            ON user_id = id
            WHERE state = 1";

            $output = $db->query($input);

            return $output;
        }

        public function searchRol($rol){
            require ('../../config/connection.php');

            $input = "SELECT id, cedula, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) AS nombres, nickname, phone, address, email, photo, role_id FROM user
            INNER JOIN user_has_role
            ON user_id = id
            WHERE state = 1 AND role_id = $rol";

            $output = $db->query($input);

            return $output;
        }

    }

?>
