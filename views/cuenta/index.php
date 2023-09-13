<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/account.php');

    $Account = new Account;
    $userData = $Account->index($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil | Lotus</title>
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
            while($row = $userData->fetch_assoc()){
        ?>

        <div class="container-general">
            <div class="container-index-user con-acount-general">
                <div class="header-page-g">
                    <div class="bread-cump">
                        <span></span>
                        <a href="../dashboard/">Home</a>
                        /
                        <a>Cuenta</a>
                    </div>
                    <div class="info-page">
                        <h2><img src="../../assets/img/icons/user.svg" alt="">Mi perfil</h2>
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
                            <a href="../auth/security/logout.php" class="logouit-accout">Cerrar Sesión</a>
                            <a href="./edit.php">Editar Perfil</a>
                        </div>
                        <div class="con-src-accounts">
                            <a href="./index.php" class="acco-active">Detalle</a>
                            <a href="./edit.php">Editar Perfil</a>
                            <a href="./settings.php">Configuracion</a>
                            <a href="./logs.php">Logs</a>
                        </div>
                    </div>

                    <div class="main-sec-acco">
                        <div class="header-sec-ac">
                            <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                            <h2>Detalle</h2>
                            <div class="divider"></div>
                            <a href="./edit.php">Editar Perfil</a>
                        </div>
                        <div class="content-sec-ac">
                            <div class="con-detail-us">
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
                            </div>
                            <?php
                                if($row['passchange'] != 1){
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <h4 class="alert-heading"><img src="../../assets/img/icons/light-emergency-on.svg" alt=""> ¡Necesita de su atención!</h4>
                                        <p class="text-alert-war" style="margin-bottom: 20px;">Por motivos de seguridad, es necesario que cambie su contraseña por primera vez. La contraseña predeterminada ha sido proporcionada para facilitar el inicio de sesión, pero ahora es importante que la personalice</p>
                                        <a href="./edit.php" class="change-pass-src">Cambiar contraseña</a>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
            }
            include('./modal.php');
        ?>
    </div>


    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <!-- scripts main -->

    <?php

                if(isset($_SESSION['editprofile'])){
                    if($_SESSION['editprofile'] == 1){
                        ?>
                        <script>
                            let notiuseradd = document.getElementById('notieditinfouser');
                            let toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                            toastBootstrap.show();
                        </script>
                        <?php
                        unset($_SESSION['editprofile']);
                    }
                }

                if(isset($_SESSION['updatePassword'])){
                    if($_SESSION['updatePassword'] == 1){
                        ?>
                        <script>
                            notiuseradd = document.getElementById('notieditpassword');
                            toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                            toastBootstrap.show();
                        </script>
                        <?php
                        unset($_SESSION['updatePassword']);
                    }
                }

                if(isset($_SESSION['errorUpdatePassword'])){
                    if($_SESSION['errorUpdatePassword'] == 1){
                        ?>
                        <script>
                            $(document).ready(function () {
                                $('#err_pass-change').modal('show');
                            })
                        </script>
                        <?php
                        unset($_SESSION['errorUpdatePassword']);
                    }
                }
    ?>
</body>
</html>