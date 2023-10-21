<?php
    class Account{     
        public function index($id){
            require ('../../config/connection.php');
            $input = "SELECT user.id,cedula, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname, nickname, password, phone, email,address,photo, role, passchange,ft_name,sd_name,fi_lastname, sc_lastname FROM user 
            INNER JOIN user_has_role on user_id = user.id 
            INNER JOIN role on user_has_role.role_id = role.id
            WHERE user.id = $id";

            $output = $db->query($input);
            return $output;
        }
        
        public function logs($id){
            require ('../../config/connection.php');
            $input = "SELECT descr, logs.id, date,model, CONCAT(ft_name, ' ', fi_lastname) as name_user, photo, type FROM logs INNER JOIN user ON user.id = logs.user WHERE user = $id ORDER BY `logs`.`date` DESC";
            
            $output = $db->query($input);
            return $output;
        }
        
        public function edit($id){
            require ('../../config/connection.php');
            $input = "SELECT user.id,cedula, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname, nickname, password, phone, email,address,photo, role, passchange,ft_name,sd_name,fi_lastname, sc_lastname FROM user 
            INNER JOIN user_has_role on user_id = user.id 
            INNER JOIN role on user_has_role.role_id = role.id
            WHERE user.id = $id";
    
            $output = $db->query($input);
            return $output;
        }

        public function update($ft_name, $sd_name, $fi_lastname, $sc_lastname, $email, $phone, $address, $imgChange, $documento, $changepicturestate){
            require ('../config/connection.php');

            $input = "SELECT photo FROM user WHERE cedula = $documento";
            $output = $db->query($input);
            $deletestate = false;
            $namePastPic = '';

            while($row = $output->fetch_assoc()){
                if($row['photo'] != 'default.png'){
                    $deletestate = true;
                    $namePastPic = $row['photo'];
                }
            }

            if($changepicturestate == 1){
                $folder = '../assets/img/profilePictures/';
                $namePiture = $imgChange['name'];
                $typedPiture = pathinfo($imgChange['name'], PATHINFO_EXTENSION);
                $sizePitureFile = $imgChange['size'];
                $filefinal = $documento .'.'.$typedPiture;
                
                if($deletestate){
                    unlink($folder . $namePastPic);
                }
                
                if(move_uploaded_file($imgChange['tmp_name'], $folder . $filefinal)){
                    chmod($folder . $filefinal, 0777);
                    $input = "UPDATE user SET ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email', photo = '$filefinal' WHERE cedula = $documento";
    
                    mysqli_query($db, $input);
                    
                    $_SESSION['photo'] = $filefinal;
                    $_SESSION['editprofile'] = 1;
    
                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
    
                    $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del perfil', $date, 5);
    
                }
            }elseif($changepicturestate == 2){
                if($deletestate){
                    unlink('../assets/img/profilePictures/' . $namePastPic);
                }

                $input = "UPDATE user SET ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email', photo = 'default.png' WHERE cedula = $documento";

                $_SESSION['photo'] = 'default.png';
    
                mysqli_query($db, $input);
                $_SESSION['editprofile'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del perfil', $date, 5);

            }elseif($changepicturestate == 0){

                $input = "UPDATE user SET ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email' WHERE cedula = $documento";
    
                mysqli_query($db, $input);
                $_SESSION['editprofile'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del perfil', $date, 5);
            }
        }

        public function updatePassword($currentPasword, $newPassword, $id){
            require ('../config/connection.php');
            include('../model/log.php');

            $input = "SELECT *FROM user WHERE id = $id";
            $output = $db->query($input);

            while($row = $output-> fetch_assoc()){
                if(password_verify($currentPasword, $row['password'])){
                    $_SESSION['updatePassword'] = 1;
                    
                    $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    $input = "UPDATE user SET password='$newPassword', passchange = 1 WHERE id = $id";
                    mysqli_query($db, $input);

                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;

                    $Log->store($_SESSION['user_id'], '1', 'Cambio de contraseña', $date, 5);
                    
                }else{
                    $_SESSION['errorUpdatePassword'] = 1;
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;

                    $Log->store($_SESSION['user_id'], '4', 'Intento fallido de cambiar contraseña', $date, 5);
                }
            }
        }

    }


?>
