<?php 
    $role = '';
    if($_SESSION['role_id'] == 1){
        $role = 'Administrador';
        
    }elseif($_SESSION['role_id'] == 4){
        $role = 'Gerente';

    }elseif($_SESSION['role_id'] == 6){
        $role = 'Trabajador';

    }

    include('../../model/log.php');
    $Log = new Log;
    $dataLogs = $Log->index($_SESSION['role_id']);
?>

<div class="navbar">
            <section class="div-navbar-l">
                <div class="btn-menu">
                    <img src="../../assets/img/icons/menuham.svg" alt="Menu" id="btn-menu">
                </div>
                <a href="../dashboard/" class="icon-hre">
                    <img src="../../assets/img/icons/lotus.svg" alt="Logo">
                </a>

                <div class="con-inpt-b item-side-left">
                    <input type="search" name="search" id="search" placeholder="Buscar #, serial, referencia">
                </div>
                <div class="btn-buscador-s item-side-left">
                    <img src="../../assets/img/icons/search.svg" alt="searching">
                </div>

                <div class="btn-desp-sidebar" id="btn-desp-sidebar">
                    <img src="../../assets/img/icons/angle-left.svg" alt="angle-left">
                </div>

            </section>
            <section class="div-navbar-r">
                <div class="con-inpt-b">
                    <input type="search" name="search" id="search" placeholder="Buscar #, serial, referencia">
                </div>
                <div class="btn-buscador-s">
                    <img src="../../assets/img/icons/search.svg" alt="searching">
                </div>
                <div class="btn-config">
                    <img src="../../assets/img/icons/settings.svg" alt="searching">
                </div>
                <div class="btn-logs-s" id="btn-logs-s">
                    <img src="../../assets/img/icons/logs.svg" alt="logs">
                </div>
                <div class="con-profile-s">
                    <div class="info-u-s" id="info-us-na">
                        <div class="con-name-s"><h3><?php echo $_SESSION['ft_name'] .' '. $_SESSION['fi_lastname'] ?></h3></div>
                        <div class="con-rol-s"><p><?php echo $role ?></p></div>
                        <div class="con-img-s">
                            <img src="../../assets/img/profilePictures/<?php echo $_SESSION['photo'] ?>" alt="image-profile">
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="dronwdonw-nav-user " id="drown-navbar">
            <a href="../cuenta/">Mi perfil</a>
            <div class="divider-dron"></div>
            <a href="../cuenta/settings.php">Configuraciones</a>
            <a href="../auth/security/logout.php">Cerrar sesión</a>
        </div>
        <div class="dronwdonw-logs">
            <div class="header-logs-d">
                <h3>Logs</h3>
                <img src="../../assets/img/icons/cross-small.svg" alt="" class="cross" id="cross-logs">
            </div>
            <div class="body-logs-d">
                <?php
                    if(mysqli_num_rows($dataLogs) > 0){
                        $count = 0;
                        while($row = $dataLogs->fetch_assoc()){
                            if($row['type'] == '1'){
                                $iconLogs = 'pen-circleg.svg';
                            }else if($row['type'] == '2'){
                                $iconLogs = 'addg.svg';
                            }else if($row['type'] == '3'){
                                $iconLogs = 'comment-xmarkg.svg';
                            }else if($row['type'] == '4'){
                                $iconLogs = 'bug-slash.svg';
                            }


                            if($row['model'] == '1'){
                               $enlace = '../product/';
                            }elseif($row['model'] == '2'){
                                $enlace = '../user/';
                            }elseif($row['model'] == '3'){
                                $enlace = '../bill/';
                            }elseif($row['model'] == '4'){
                                $enlace = '../service/';
                            }elseif($row['model'] == '5'){
                                $enlace = '../account/';
                            }elseif($row['model'] == '6'){
                                $enlace = '../cotizacion/';
                            }
                            ?>
                                <div class="log-d">
                                    <div class="info-ico"><img src="../../assets/img/icons/<?php echo $iconLogs ?>" alt=""></div>
                                    <div class="info-l"><?php echo $row['descr'] ?></div>
                                    <div class="info-date-l"><?php echo $row['date'] ?></div>
                                    <div class="info-au" title="<?php echo $row['name_user']?>">Por <img src="../../assets/img/profilePictures/<?php echo $row['photo'] ?>" alt="imagen-usuario" class="autor-log-img"></div>
                                    <div class="con-red"><a href="<?php echo $enlace?>">Ir</a></div>
                                </div>
                            <?php
                            $count = $count + 1;
                        }
                        $progreso = 30;
                        for($i = 0; $i < $count - 1; $i++){
                            ?>
                            <div class="line-sec-log" style="top: <?php echo $progreso ?>px;"></div>    
                            <?php
                            $progreso = $progreso + 90;
                        }
                    }else{
                        ?>
                            <div class="log-v">
                                <img src="../../assets/img/icons/empty.png" alt="">
                                <h2>Sin actividad, por ahora.</h2>
                            </div>
                        <?php
                    }
                ?>
            </div>
            <div class="con-footer-logs-m"><a href="../log/">Ver más <img src="../../assets/img/icons/angle-circle-right.svg" alt=""></a></div>
        </div>