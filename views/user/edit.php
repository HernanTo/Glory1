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
    $roleU = 0;
    $idUserEdit = 0;    
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
            header('Location: ../cuenta/edit.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar <?php echo $_GET['cc'] ?> | Lotus</title>
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
                    $roleU = $row['role_id'];
                    $idUserEdit = $row['id'];

        ?>

        <div class="container-general">
            <div class="container-index-user con-acount-general">
                <div class="header-page-g">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./index.php">Usuarios</a>
                        /
                        <a href="./user.php?cc=<?php echo $row['cedula'] ?>"><?php echo $row['nameLas'] ?></a>
                        /
                        <a>Editar</a>
                    </div>
                    <div class="info-page">
                        <h2><img src="../../assets/img/icons/user-gear.svg" alt="">Editar - <?php echo $row['cedula'] ?></h2>
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
                            <a href="./user.php?cc=<?php echo $row['cedula'] ?>" class="logouit-accout">Cancelar</a>
                            <a onclick="confirmTrash(<?php echo $row['id'] ?>, '<?php echo $row['fullname'] ?>')" class="btn-elim-user">Eliminar</a>
                        </div>
                        <div class="con-src-accounts">
                            <a href="./index.php">Detalle</a>
                            <a href="./edit.php" class="acco-active">Editar</a>
                        </div>
                    </div>

                    <div class="main-sec-acco">
                        <div class="header-sec-ac header-ac">
                            <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                            <h2>Editar</h2>
                            <div class="divider"></div>
                        </div>
                        <div class="content-sec-ac">
                            <form action="../../controller/user.php?action=update" method="post" enctype="multipart/form-data">
                                <input type="text" name="ccUserEdit" value="<?php echo $row['cedula'] ?>" style="display: none;">
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
                                <section class="edit-two-c-ac">
                                    <label>Documento</label>
                                    <input type="number" name="cc-change" id="cc" value="<?php echo $row['cedula'] ?>" required>
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
                                <?php
                                    if($row['role_id'] == 5){
                                        ?>
                                        <section class="edit-two-c-ac">
                                            <label>Placa</label>
                                            <input type="text" name="placa" id="Placa" value="<?php echo $row['placa'] ?>">
                                        </section>
                                        <section class="edit-two-c-ac">
                                            <label>Modelo</label>
                                            <input type="text" name="modelo" id="Modelo" value="<?php echo $row['modelo'] ?>">
                                        </section>
                                        <?php
                                    }else{
                                        ?>

                                        <input type="text" name="placa" id="Placa" value="0" style="display: none;">
                                        <input type="text" name="modelo" id="Modelo" value="0" style="display: none;">
                                        <?php
                                    }
                                ?>
                                <section class="con-sub-edi-p">
                                    <input type="submit" value="Actualizar datos">
                                </section>
                            </div>
                            </form>
                        </div>

                    </div>
                    <?php
                        if($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 4){
                            ?>
                            <div class="main-sec-acco" style="margin-top: 20px;">
                                <div class="header-sec-ac header-ac">
                                    <img src="../../assets/img/icons/id-card-clip-alt.svg" alt="information-user">
                                    <h2>Editar Rol</h2>
                                    <div class="divider"></div>
                                </div>
                                <div class="content-sec-ac">
                                    <form action="../../controller/user.php?action=updateRole" method="post" enctype="multipart/form-data">
                                        <input type="number" value="<?php echo $idUserEdit ?>" name="iduseredit" style="display: none;">
                                    <div class="form-floating form-lotus rol-form-ge">
                                        <select class="form-select rol__new__user" id="floatingSelect" aria-label="Floating label select example" name="role" style="margin-bottom: 30px;">
                                                <?php
                                                    while($fila = $dataRole->fetch_assoc()){
                                                        if($fila['id'] == $roleU){
                                                            ?><option value="<?php echo $fila['id'] ?>" selected><?php echo $fila['role'] ?></option><?php
        
                                                        }else{
        
                                                            ?><option value="<?php echo $fila['id'] ?>"><?php echo $fila['role'] ?></option><?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                            <label for="floatingSelect">Rol</label>
                                        </div>
                                        <section class="con-sub-edi-p">
                                            <input type="submit" value="Editar rol">
                                        </section>
                                    </form>
                                </div>
        
                            </div>
                            <?php
                        }
                    ?>

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
    <script src="../js/editUser.js"></script>
    <!-- scripts main -->
</body>
</html>