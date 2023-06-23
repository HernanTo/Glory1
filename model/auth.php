<?php
    class Auth {
        public function login($nickname, $password){
            require ('../config/connection.php');
            $verification = false;

            $input = "SELECT * FROM user WHERE nickname = '$nickname'";
            $output = $db->query($input);
            $totalRows    = mysqli_num_rows($output); 

            if($totalRows > 0){
                while($row = $output->fetch_assoc()){
                    if(password_verify($password, $row['password'])){
                        $verification = true;
                    }else{
                        $verification = false;
                        $_SESSION['errorLogin'] = 'password';
                        header('Location:  ../views/auth/login.php');
                    }
                }
            }else{
                $_SESSION['errorLogin'] = 'nickname';
                header('Location:  ../views/auth/login.php');
            }

            if($verification){
                $input = "SELECT user_id, CONCAT(ft_name, ' ', sd_name, ' ', fi_lastname, ' ', sc_lastname) as name, nickname, email, photo, role_id, role.role as role_user, ft_name, fi_lastname FROM user
                INNER JOIN user_has_role
                ON user.id = user_has_role.user_id
                INNER JOIN role
                ON role_id = role.id
                WHERE nickname = 'hernanto' AND state = 1";

                $output = $db->query($input);
                $totalRows    = mysqli_num_rows($output); 

                if($totalRows > 0){
                    while($row = $output->fetch_assoc()){
                        $_SESSION['login'] = 1;
                        $_SESSION['ft_name'] = $row['ft_name'];
                        $_SESSION['fi_lastname'] = $row['fi_lastname'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['nickname'] = $row['nickname'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['photo'] = $row['photo'];
                        $_SESSION['role_id'] = $row['role_id'];
                        $_SESSION[$row['role_user']] = 1;
                    }
                    header('Location: ../views/dashboard/');

                }else{
                    $_SESSION['errorLogin'] = 'nickname';
                    header('Location:  ../views/auth/login.php');
                }
            }

        }
    }
?>