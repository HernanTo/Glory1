<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/user.php');
    require ('../../model/role.php');
    $Role = new Role;
    $dataRole = $Role->index();

    $User = new User;
    if(isset($_GET['cc'])){
        if($_GET['cc'] == ''){
            header('Location: ./');
        }else{
            $userData = $User->searchUser($_GET['cc']);
        }
    }else{
        header('Location: ./');
    }

    foreach($userData as $row){
        if($_SESSION['role_id'] == 4){
            if($row['role_id'] == 1){
                $permis = false;
            }
        }else if($_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 7){
            if($row['role_id'] != 5){
                $permis = false;
            }else{
                $permis = true;
            }
        }else{
            $permis = true;
        }

        if($_SESSION['user_id'] == $row['id']){
            header('Location: ../cuenta/');
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_GET['cc'] ?> | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/account.css">
    
    <!-- Css page -->

</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
            if(mysqli_num_rows($userData) > 0 && $permis){
            foreach($userData as $row){
        ?>

        <div class="container-general">
            <div class="container-index-user con-acount-general">
                <div class="header-page-g">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Usuarios</a>
                        /
                        <a><?php echo $row['nameLas'] ?></a>
                    </div>
                    <div class="info-page">
                        <h2><img src="../../assets/img/icons/user.svg" alt=""><?php echo $row['nameLas'] ?> - <?php echo $row['cedula'] ?></h2>
                    </div>
                </div>
                <div class="content-account">
                    <div class="info-general-u">
                        <div class="con-picture-profi">
                            <img src="../../assets/img/profilePictures/<?php echo $row['photo'] ?>" alt="image-profile">
                        </div>
                        <div class="con-info-u-b">
                            <h2><?php echo $row['nameLas'] ?></h2>
                            <p><img src="../../assets/img/icons/briefcase.svg" alt=""><?php echo $row['role'] ?></p>
                            <p><img src="../../assets/img/icons/envelope.svg" alt=""><?php echo $row['email'] ?></p>
                            <p>@<?php echo $row['nickname'] ?></p>
                        </div>
                        <div class="acti-acco">
                            <a href="./edit.php?cc=<?php echo $row['cedula'] ?>">Editar</a>
                            <a onclick="confirmTrash(<?php echo $row['id'] ?>, '<?php echo $row['fullname'] ?>')" class="btn-elim-user">Eliminar</a>
                        </div>
                        <div class="con-src-accounts">
                            <a href="./index.php" class="acco-active">Detalle</a>
                            <a href="./edit.php?cc=<?php echo $row['cedula'] ?>">Editar</a>
                        </div>
                    </div>

                    <div class="main-sec-acco">
                        <div class="header-sec-ac">
                            <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                            <h2>Detalle</h2>
                            <div class="divider"></div>
                            <a href="./edit.php?cc=<?php echo $row['cedula'] ?>">Editar</a>
                        </div>
                        <div class="content-sec-ac">
                            <div class="con-detail-us">
                                <label>Documento</label>
                                <span><?php echo $row['cedula'] ?></span>
                                <label>Nombre completo</label>
                                <span><?php echo $row['fullname'] ?></span>
                                <label>Nickname</label>
                                <span>@<?php echo $row['nickname'] ?></span>
                                <label>Email</label>
                                <span><?php echo $row['email'] ?></span>
                                <label>Telefono</label>
                                <span><?php echo $row['phone'] ?></span>
                                <label>Dirección</label>
                                <span><?php echo $row['address'] ?></span>
                                <?php
                                    if($row['role_id'] == 5){
                                        ?>
                                        <label>Placa</label>
                                        <span><?php echo $row['placa'] ?></span>
                                        <label>Modelo</label>
                                        <span><?php echo $row['modelo'] ?></span>
                                        <?php
                                    }
                                ?>
                            </div>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
            }
        }else{
            ?>
            
            <div class="container-general con-g-nf">
                <div class="con-not-found">
                    <img src="../../assets/img/icons/magnifying-glass.gif" alt="search" class="img-nof-s">
                    <h2>No se encontraron resultados <img src="../../assets/img/icons/dead.svg" alt=""></h2>
                    <a href="./">Volver</a>
                </div>
            </div>
            <?php
        }

        include('./components/modal.php');

        ?>
    </div>


    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <!-- scripts main -->
</body>
</html>