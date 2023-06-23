<?php
    include('./security/verAuth.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/login.css">
    <!-- Css page -->

</head>
<body>
    <div class="con-main-gest">
        <div class="contenedor">
            <div class="glass">

            </div>
            <div class="con-login con-info-ge">
                <div class="head-login">
                    <h2>Iniciar sesión</h2>
                </div>
                <div class="body-login">
                    <form action="../../controller/auth.php?action=login" method="post"  autocomplete="nope">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nickname_input" placeholder="name@example.com" name="nickname">
                            <label for="floatingInput">Nombre de usuario</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                El usuario que ingresaste no esta conectado a una cuenta
                            </div>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password_input" placeholder="Password" name="password" >
                            <label for="floatingPassword">Contraseña</label>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                La contraseña que ingresaste es incorrecta.
                            </div>
                        </div>
                        <div class="con-btn-lo">
                            <input type="submit" value="Ingresar">
                        </div>
                    </form>
                </div>
                <div class="foo-login">
                    <p>¿Olvidó su contraseña? <a href="./forgotPassword.php">Click aquí</a></p>
                    <img src="../../assets/img/icons/lotus.svg" alt="icon-lotus">
                </div>
            </div>
        </div>
    </div>

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    
    <!-- scripts main -->
    
    <?php
        if(isset($_SESSION['errorLogin'])){
            echo $_SESSION['errorLogin'] == 'nickname' ? "<script> $('#nickname_input').addClass('is-invalid') </script>" : "<script> $('#password_input').addClass('is-invalid') </script>";
            unset( $_SESSION['errorLogin']);
        }
    ?>
</body>
</html>