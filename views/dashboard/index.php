<?php 
    include('../auth/security/securityGeneral.php');
    require ('../../model/user.php');
    $User = new User;
    $seller = $User->searchRol(6);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <!-- Css page -->

</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
        ?>

        <div class="container-general">
            <div class="container-dash">
                <div class="func-dash">
                    <a href="../bill/add-bill.php">Nueva Factura</a>
                    <a href="../user/" class="user-btn-d">Usuarios</a>
                </div>
                
                <a href="" class="con-aler-r">
                   <span class="main-alert-r">¡Hola!</span>
                   <span class="secundary-alert-r">¿Necesitas ayuda?</span>
                </a>
            </div>
        </div>
    </div>

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    
    <!-- scripts main -->
</body>
</html>