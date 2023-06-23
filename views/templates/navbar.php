<?php 
    $role = '';
    if($_SESSION['role_id'] == 1){
        $role = 'Administrador';
        
    }elseif($_SESSION['role_id'] == 4){
        $role = 'Gerente';

    }elseif($_SESSION['role_id'] == 6){
        $role = 'Trabajador';

    }
?>

<div class="navbar">
            <section class="div-navbar-l">
                <div class="btn-menu">
                    <img src="../../assets/img/icons/menuham.svg" alt="Menu" id="btn-menu">
                </div>
                <a href="" class="icon-hre">
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
                <div class="btn-logs-s">
                    <img src="../../assets/img/icons/logs.svg" alt="logs">
                </div>
                <div class="con-profile-s">
                    <div class="info-u-s">
                        <div class="con-name-s"><h3><?php echo $_SESSION['ft_name'] .' '. $_SESSION['fi_lastname'] ?></h3></div>
                        <div class="con-rol-s"><p><?php echo $role ?></p></div>
                        <div class="con-img-s">
                            <img src="../../assets/img/profilePictures/<?php echo $_SESSION['photo'] ?>" alt="image-profile">
                        </div>
                    </div>
                </div>
            </section>
        </div>