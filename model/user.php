<?php
    class User{
        public function store($ft_name, $sd_name, $ft_lastname, $st_lastname, $cedula, $address, $email, $phone, $role){
            require ('../config/connection.php');
            
            $nickname = generatorNicknames($ft_name, $ft_lastname);
            $password = password_hash($cedula, PASSWORD_DEFAULT);
            
            $input = "INSERT INTO user(cedula, ft_name, sd_name, fi_lastname, sc_lastname, nickname, password, phone, address, email, photo) VALUES ($cedula,'$ft_name','$sd_name','$ft_lastname','$st_lastname','$nickname','$password',$phone,'$address','$email','default.png')";
            
            mysqli_query($db, $input);
            $user = mysqli_insert_id($db);
            
            $input = "INSERT INTO user_has_role(user_id, role_id, state) VALUES ('$user','$role',1)";
            mysqli_query($db, $input);
            
            $_SESSION['user-add'] = true;

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó un nuevo usuario', $date, 2);
            
            header('Location: ../views/user/');
        }

        public function storebill($ft_name, $sd_name, $ft_lastname, $st_lastname, $cedula, $address, $email, $phone, $role){
            require ('../config/connection.php');
            
            $nickname = generatorNicknames($ft_name, $ft_lastname);
            $password = password_hash($cedula, PASSWORD_DEFAULT);
            
            $input = "INSERT INTO user(cedula, ft_name, sd_name, fi_lastname, sc_lastname, nickname, password, phone, address, email, photo) VALUES ($cedula,'$ft_name','$sd_name','$ft_lastname','$st_lastname','$nickname','$password',$phone,'$address','$email','../../assets/img/profilePictures/default.png')";
            echo $input;
            
            // mysqli_query($db, $input);
            $user = mysqli_insert_id($db);
            
            $input = "INSERT INTO user_has_role(user_id, role_id, state) VALUES ('$user','$role',1)";
            // mysqli_query($db, $input);
            
            $_SESSION['user-add'] = true;

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '2', 'Se creó un nuevo usuario', $date, 2);
            
            header('Location: ../views/bill/add-bill.php');
        }
        
        public function index(){
            require ('../../config/connection.php');

            if($_SESSION['role_id'] == '4'){
                $query = "role_id != 1";
            }else if($_SESSION['role_id'] == '6' || $_SESSION['role_id'] == '7'){
                $query = "role_id = 5";
            }else{
                $query = "True";

            }
            $idUser = $_SESSION['user_id'];

            $input = "SELECT id, cedula, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) AS nombres, nickname, phone, address, email, photo, role_id FROM user
            INNER JOIN user_has_role
            ON user_id = id
            WHERE state = 1 and id != $idUser and $query";

            $output = $db->query($input);

            return $output;
        }

        public function searchRol($rol){
            require ('../../config/connection.php');

            $input = "SELECT id, cedula, CONCAT(ft_name, ' ', fi_lastname) AS nombres, nickname, phone, address, email, photo, role_id FROM user
            INNER JOIN user_has_role
            ON user_id = id
            WHERE state = 1 AND role_id = $rol";

            $output = $db->query($input);

            return $output;
        }

        public function searchUser($id){
            require ('../../config/connection.php');

            $input = "SELECT user.id,cedula, placa, modelo, CONCAT(ft_name, ' ',fi_lastname) AS nameLas, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as fullname, nickname, password, phone, email,address,photo, role, role_id, passchange,ft_name,sd_name,fi_lastname, sc_lastname FROM user 
            INNER JOIN user_has_role on user_id = user.id 
            INNER JOIN role on user_has_role.role_id = role.id
            WHERE user.cedula = $id";

            $output = $db->query($input);


            return $output;
        }

        public function update($ft_name, $sd_name, $fi_lastname, $sc_lastname, $email, $phone, $address, $imgChange, $documento, $changepicturestate, $ccChange, $placa, $modelo){
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
                    $input = "UPDATE user SET cedula = '$ccChange', ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email', photo = '$filefinal', placa= '$placa' , modelo='$modelo' WHERE cedula = $documento";
                    echo $input;
    
                    mysqli_query($db, $input);
                    
                    $_SESSION['editUser'] = 1;
    
                    include('../model/log.php');
                    date_default_timezone_set('America/Bogota');
                    $date =  date("Y-m-d H:i:s");
                    $Log = new Log;
    
                    $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del usuario ' . $ccChange, $date, 2);
    
                }
            }elseif($changepicturestate == 2){
                if($deletestate){
                    unlink('../assets/img/profilePictures/' . $namePastPic);
                }

                $input = "UPDATE user SET cedula = '$ccChange', ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email', photo = 'default.png', placa= '$placa' , modelo='$modelo' WHERE cedula = $documento";
    
                mysqli_query($db, $input);
                $_SESSION['editUser'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del usuario ' . $ccChange, $date, 2);

            }elseif($changepicturestate == 0){

                $input = "UPDATE user SET cedula = '$ccChange', ft_name = '$ft_name', sd_name = '$sd_name', fi_lastname = '$fi_lastname', sc_lastname = '$sc_lastname', phone = '$phone', address = '$address', email = '$email', placa= '$placa' , modelo='$modelo' WHERE cedula = $documento";
    
                mysqli_query($db, $input);
                $_SESSION['editUser'] = 1;

                include('../model/log.php');
                date_default_timezone_set('America/Bogota');
                $date =  date("Y-m-d H:i:s");
                $Log = new Log;

                $Log->store($_SESSION['user_id'], '1', 'Se editarón datos del usuario ' . $ccChange, $date, 2);
            }
        }

        public function delete($id){
            require ('../config/connection.php');

            $input = "UPDATE user_has_role SET state= '0' WHERE user_id = $id";
            mysqli_query($db, $input);

            $_SESSION['userDelete'] = 1;

            include('../model/log.php');
            date_default_timezone_set('America/Bogota');
            $date =  date("Y-m-d H:i:s");
            $Log = new Log;

            $Log->store($_SESSION['user_id'], '3', 'Se eliminó al usuario ' . $id , $date, 2);

        }

    }

?>
