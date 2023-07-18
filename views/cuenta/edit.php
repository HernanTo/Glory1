<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/account.php');

    $Account = new Account;
    $userData = $Account->edit($_SESSION['user_id']);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil | Lotus</title>
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
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./index.php">Cuenta</a>
                        /
                        <a>Editar Perfil</a>
                    </div>
                    <div class="info-page">
                        <h2><img src="../../assets/img/icons/user.svg" alt="">Editar Perfil</h2>
                    </div>
                </div>
                <div class="content-account">
                    <div class="info-general-u">
                        <div class="con-picture-profi">
                            <img src="../../assets/img/profilePictures/<?php echo $row['photo'] ?>" alt="image-profile" class="prev-photo-ed">
                        </div>
                        <div class="con-info-u-b">
                            <h2><?php echo $row['nameLas'] ?></h2>
                            <p><img src="../../assets/img/icons/briefcase.svg" alt=""><?php echo $row['role'] ?></p>
                            <p><img src="../../assets/img/icons/envelope.svg" alt=""><?php echo $row['email'] ?></p>
                            <p>@<?php echo $row['nickname'] ?></p>
                        </div>
                        <div class="acti-acco">
                            <a href="../auth/security/logout.php" class="logouit-accout">Cerrar Sesión</a>
                        </div>
                        <div class="con-src-accounts">
                            <a href="./index.php">Detalle</a>
                            <a href="./edit.php" class="acco-active">Editar Perfil</a>
                            <a href="./settings.php">Configuracion</a>
                            <a href="./logs.php">Logs</a>
                        </div>
                    </div>

                    <div class="main-sec-acco">
                        <div class="header-sec-ac header-ac">
                            <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                            <h2>Editar perfil</h2>
                            <div class="divider"></div>
                        </div>
                        <div class="content-sec-ac">
                            <form action="../../controller/account.php?action=update" method="post" enctype="multipart/form-data">
                            <div class="con-detail-us-f">
                                <section class="edit-two-c-ac">
                                    <label>Avatar</label>
                                    <div class="con-img-prof-e">
                                        <img src="../../assets/img/profilePictures/<?php echo $row['photo'] ?>" alt="foto-profile" class="edit-profile-img" id="edit-profile-img">
                                        <div class="trash-pic" id="trash-pic" title="Eliminar avatar"> <img src="../../assets/img/icons/broom.svg" alt=""></div>
                                        <label for="img-profil-c" class="edit-picture-profi"  title="Editar avatar"><img src="../../assets/img/icons/pen-circle.svg" alt=""></label>
                                        <input type="file" name="img-profil-c" id="img-profil-c" style="display: none" accept="image/png,image/jpeg">
                                        <input type="number" name="changepicturestate" value="0" id="changepicturestate" style="display: none;"> 
                                    </div>
                                </section>
                                <section class="edit-thre-c-ac">
                                    <label>Nombres</label>
                                    <input type="text" name="ft_name" id="ft_name" value="<?php echo $row['ft_name'] ?>" required>
                                    <input type="text" name="sd_name" id="sd_name" value="<?php echo $row['sd_name'] ?>">
                                </section>
                                <section class="edit-thre-c-ac">
                                    <label>Apellidos</label>
                                    <input type="text" name="fi_lastname" id="fi_lastname" value="<?php echo $row['fi_lastname'] ?>" required>
                                    <input type="text" name="sc_lastname" id="sc_lastname" value="<?php echo $row['sc_lastname'] ?>">
                                </section>
                                <section class="edit-two-c-ac">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" value="<?php echo $row['email'] ?>" required>
                                </section>
                                <section class="edit-two-c-ac">
                                    <label>Teléfono</label>
                                    <input type="number" name="phone" id="phone" value="<?php echo $row['phone'] ?>" required>
                                </section>
                                <section class="edit-two-c-ac">
                                    <label>Dirección</label>
                                    <input type="text" name="address" id="address" value="<?php echo $row['address'] ?>">
                                </section>
                                <section class="con-sub-edi-p">
                                    <input type="submit" value="Actualizar datos">
                                </section>
                            </div>
                            </form>
                        </div>

                    </div>

                    <div class="main-sec-acco" style="margin-top: 40px;">
                        <div class="header-sec-ac header-ac">
                            <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                            <h2>Editar perfil</h2>
                            <div class="divider"></div>
                        </div>
                        <div class="content-sec-ac">
                            <?php
                                if($row['passchange'] != 1){
                                    ?>
                                    <div class="alert alert-warning alert-dismissible fade show">
                                        <h4 class="alert-heading"><img src="../../assets/img/icons/light-emergency-on.svg" alt=""> ¡Necesita de su atención!</h4>
                                        <p class="text-alert-war">Por motivos de seguridad, es necesario que cambie su contraseña por primera vez. La contraseña predeterminada ha sido proporcionada para facilitar el inicio de sesión, pero ahora es importante que la personalice</p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                    <?php
                                }
                            ?>
                            <form action="../../controller/account.php?action=updatePassword" method="post" autocomplete="off" id="form-change-password" style="margin-top: 10px;">
                                <section class="all-col-edit-ps">
                                    <label for="current-password" class="form-label">Contraseña actual</label>
                                    <input type="password" class="form-control" id="current-password" name="current-password" required>
                                    <div class="invalid-feedback" id="current-pasw-inv">Ingrese una contraseña válida</div>
                                </section>

                                <section>
                                    <label for="new-password" class="form-label">Nueva contraseña</label>
                                    <input type="password" autocomplete=“new-password” class="form-control" id="new-password" name="new-password" required>
                                    <div class="invalid-feedback" id="new-pass-chang">Contraseña no válida, asegúrase de que la nueva contraseña cumpla con los siguientes requisitos: mínimo 8 caracteres, al menos un número y una letra mayúscula.</div>
                                </section>

                                <section>
                                    <label for="repeat-new-password" class="form-label">Confirmar nueva contraseña</label>
                                    <input type="password" class="form-control" id="repeat-new-password" name="repeat-new-password" required>
                                    <div class="invalid-feedback">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</div>
                                </section>

                                <section class="con-sub-edi-p con-btn-pass">
                                    <input type="button" value="Actualizar datos" id="btn-passw">
                                </section>
                            </form>       
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
    <script src="../js/editProfile.js"></script>
    <script>
        const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
        const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
    </script>
    <!-- scripts main -->
</body>
</html>