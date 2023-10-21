<?php
    session_start();
    require ('../model/account.php');

    class accountControlller{
        public function update(){
            $ft_name = $_POST['ft_name'];
            $sd_name = $_POST['sd_name'];
            $fi_lastname = $_POST['fi_lastname'];
            $sc_lastname = $_POST['sc_lastname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $imgChange = $_FILES['img-profil-c'];
            $changepicturestate = $_POST['changepicturestate'];

            $Account = new Account;
            $Account->update($ft_name,$sd_name,$fi_lastname,$sc_lastname,$email,$phone,$address,$imgChange, $_SESSION['cedula'], $changepicturestate);
            
            header('Location: ../views/cuenta/');
        }
        
        public function updatePassword(){
            $currentPassword = $_POST['current-password'];
            $newPassword = $_POST['new-password'];
            $Account = new Account;
            $Account->updatePassword($currentPassword, $newPassword, $_SESSION['user_id']);
            
            header('Location: ../views/cuenta/');
        }
    }

    $accountControlller = new accountControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $accountControlller-> $fuct();
    }   
?>