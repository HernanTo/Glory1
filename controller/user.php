<?php
    session_start();
    require ('../model/user.php');

    class userControlller{
        public function index(){
            $User = new User;
            $data = $User->index();

        }
        public function store(){
            $ft_name = $_POST['ft_name'];
            $sd_name = $_POST['sd_name'];
            $ft_lastname = $_POST['ft_lastname'];
            $st_lastname = $_POST['st_lastname'];
            $cedula = $_POST['cedula'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $role = $_POST['role'];

            $User = new User;
            $User->store(
                $ft_name,
                $sd_name,
                $ft_lastname,
                $st_lastname,
                $cedula,
                $address,
                $email,
                $phone,
                $role
            );
        }

        public function delete(){
            $User = New User;
            $User->delete($_POST['id']);

            header('Location: ../views/user/');
            
        }

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
            $idUserEdit = $_POST['ccUserEdit'];
            $ccChange = $_POST['cc-change'];
            $placa = $_POST['placa'];
            $modelo = $_POST['modelo'];

            $User = new User;
            $User->update($ft_name,$sd_name,$fi_lastname,$sc_lastname,$email,$phone,$address,$imgChange, $idUserEdit, $changepicturestate, $ccChange, $placa, $modelo);
            
            header('Location: ../views/user/');
        }
    }

    $userControlller = new userControlller;

    if(isset($_GET['action'])){
        $fuct = $_GET['action'];
        $userControlller-> $fuct();
    }


    function generatorNicknames($ft_name, $ft_lastname){
    
        function eliminar_acentos($cadena){
        
            //Reemplazamos la A y a
            $cadena = str_replace(
            array('Á', 'À', 'Â', 'Ä', 'á', 'à', 'ä', 'â', 'ª'),
            array('A', 'A', 'A', 'A', 'a', 'a', 'a', 'a', 'a'),
            $cadena
            );
    
            //Reemplazamos la E y e
            $cadena = str_replace(
            array('É', 'È', 'Ê', 'Ë', 'é', 'è', 'ë', 'ê'),
            array('E', 'E', 'E', 'E', 'e', 'e', 'e', 'e'),
            $cadena );
    
            //Reemplazamos la I y i
            $cadena = str_replace(
            array('Í', 'Ì', 'Ï', 'Î', 'í', 'ì', 'ï', 'î'),
            array('I', 'I', 'I', 'I', 'i', 'i', 'i', 'i'),
            $cadena );
    
            //Reemplazamos la O y o
            $cadena = str_replace(
            array('Ó', 'Ò', 'Ö', 'Ô', 'ó', 'ò', 'ö', 'ô'),
            array('O', 'O', 'O', 'O', 'o', 'o', 'o', 'o'),
            $cadena );
    
            //Reemplazamos la U y u
            $cadena = str_replace(
            array('Ú', 'Ù', 'Û', 'Ü', 'ú', 'ù', 'ü', 'û'),
            array('U', 'U', 'U', 'U', 'u', 'u', 'u', 'u'),
            $cadena );
    
            //Reemplazamos la N, n, C y c
            $cadena = str_replace(
            array('Ñ', 'ñ', 'Ç', 'ç'),
            array('N', 'n', 'C', 'c'),
            $cadena
            );
            
            return $cadena;
        }
        
        $nickname = '';
        $iter = 1;

        $charName = eliminar_acentos($ft_name);
        $charName = str_split($charName);
        foreach($charName as $key){
            if($iter <= 5){
                $nickname = $nickname . $key;
            }
            $iter = $iter + 1;
        }

        $charLastName = eliminar_acentos($ft_lastname);
        $charLastName = str_split($charLastName);
        $iter = 1;

        foreach($charLastName as $key){
            if($iter <= 5){
                $nickname = $nickname . $key;
            }
            $iter = $iter + 1;
        }
        $nickname = strtolower($nickname);

        return $nickname;
    }

?>