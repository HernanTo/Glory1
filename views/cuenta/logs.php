<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/account.php');

    $Account = new Account;
    $userData = $Account->index($_SESSION['user_id']);
    $logsAccount = $Account->logs($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Logs | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../libs/datatable/datatables.min.css">
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
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Cuenta</a>
                        /
                        <a>Mis Logs</a>
                    </div>
                    <div class="info-page">
                        <h2><img src="../../assets/img/icons/diary.png" alt="">Mis Logs</h2>
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
                        <?php
                                }
                            ?>
                        <div class="acti-acco">
                            <a href="../auth/security/logout.php" class="logouit-accout">Cerrar Sesión</a>
                            <a href="./edit.php">Editar Perfil</a>
                        </div>
                        <div class="con-src-accounts">
                            <a href="./index.php">Detalle</a>
                            <a href="./edit.php">Editar Perfil</a>
                            <a href="./settings.php">Configuracion</a>
                            <a href="./logs.php" class="acco-active">Logs</a>
                        </div>
                    </div>

                    <div class="main-sec-acco">
                        <div class="header-sec-ac">
                            <img src="../../assets/img/icons/binoculars.svg" alt="information-user">
                            <h2>Logs</h2>
                            <div class="divider"></div>
                        </div>
                        <div class="content-sec-ac">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Acción</th>
                                        <th>Desc</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while($row = $logsAccount->fetch_assoc()){
                                            if($row['type'] == '1'){
                                                $action = '<div class="action-logs edit"> Editar</div>';
                                            }else if($row['type'] == '2'){
                                                $action = '<div class="action-logs nuevo"> Crear</div>';
                                            }else if($row['type'] == '3'){
                                                $action = '<div class="action-logs eliminar"> Eliminar</div>';
                                            }else if($row['type'] == '4'){
                                                $action = '<div class="action-logs error"> Error</div>';
                                            }

                                            ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['date'] ?></td>
                                                <td><?php echo $action ?></td>
                                                <td><?php echo $row['descr'] ?></td>
                                            </tr>
                                            <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
            include('./modal.php');
        ?>
    </div>


    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <!-- scripts main -->
    <script src="../../libs/datatable/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { "width": "5%" },
                    { "width": "25%"},
                    {"width": "15%"},
                    null
                ]
            });
        });
    </script>
</html>