<?php 
    include('../auth/security/securityGeneral.php');
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
                    <a href="#">Nueva Factura</a>
                    <a href="../user/" class="user-btn-d">Usuarios</a>
                </div>
                <div class="con-report con-report-main">
                    <div class="header-report">
                        <h4 class="name-report">Reporte semanal</h4>
                        <p class="info-report">29/05/23 - 04/06/23</p>
                    </div>
                    <div class="body-report">
                        <div class="con-items-info report-thr-colum">
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-g">
                                    <img src="../../assets/img/icons/dollarb.svg" alt="dolar">
                                </figure>
                                <p>Ingresos</p>
                                <h2>240m</h2>
                            </div>
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-r">
                                    <img src="../../assets/img/icons/shopping-bag.svg" alt="shopping">
                                </figure>
                                <p>Ventas</p>
                                <h2>15</h2>
                            </div>
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-y">
                                    <img src="../../assets/img/icons/box-open-full.svg" alt="box">
                                </figure>
                                <p style="width: 150px;">Productos vendidos</p>
                                <h2>87</h2>
                            </div>
                        </div>
                        <div class="more-info-r">
                            <a href="#">Ver reporte completo</a>
                        </div>
                    </div>
                </div>

                <div class="con-report con-report-conteo">
                    <div class="header-report">
                        <h4 class="name-report">Conteo</h4>
                    </div>
                    <div class="body-report">
                        <div class="con-items-info">
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-m">
                                    <img src="../../assets/img/icons/users-alt.svg" alt="dolar">
                                </figure>
                                <p>Clientes registrados</p>
                                <h2>10</h2>
                            </div>
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-b">
                                    <img src="../../assets/img/icons/user-gear 1.svg" alt="shopping">
                                </figure>
                                <p>Empleados</p>
                                <h2>5</h2>
                            </div>
                            <div class="item-repo">
                                <figure class="icon-stadic icon-stadic-gl">
                                    <img src="../../assets/img/icons/boxes 1.svg" alt="box">
                                </figure>
                                <p>Productos</p>
                                <h2>543</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="con-usu-r">
                    <div class="con-report">
                        <div class="header-report">
                            <h4 class="name-report">Empleados</h4>
                        </div>
                        <div class="body-report body-emp-r">
                            <a href="" class="con-empl"><img src="../../assets/img/profilePictures/profile.jpg" alt=""><h3>Hernán Torres</h3><p>@HernanTo</p></a>
                            <a href=""class="con-empl"><img src="../../assets/img/profilePictures/profile.jpg" alt=""><h3>Hernán Torres</h3><p>@HernanTo</p></a>
                            <a href="" class="con-empl"><img src="../../assets/img/profilePictures/profile.jpg" alt=""><h3>Hernán Torres</h3><p>@HernanTo</p></a>
                            <a href="" class="add-user-r"><img src="../../assets/img/icons/plus_cuad.svg" alt=""><h3>Agregar usuario</h3><p></p></a>
                        </div>
                        <div class="more-info-r" style="padding-top: 10px;">
                            <a href="#">Ver Empleados</a>
                        </div>
                    </div>
                </div>
                <div class="con-en-r">
                    <div class="con-report con-report-func">
                        <div class="header-report">
                            <h4 class="name-report">Enlaces</h4>
                        </div>
                        <div class="body-report body-enl-r">
                            <div class="con-items-info">
                                <a href="#" class="enl-f-r"><p>Registrar usuario</p><img src="../../assets/img/icons/share-square.svg" alt=""></a>
                                <a href="#" class="enl-f-r"><p>Listar Productos</p><img src="../../assets/img/icons/share-square.svg" alt=""></a>
                                <a href="#" class="enl-f-r"><p>Nueva factura</p><img src="../../assets/img/icons/share-square.svg" alt=""></a>
                            </div>
                        </div>
                    </div>
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