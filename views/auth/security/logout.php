<?php
    session_start();
    $_SESSION['login'] = null;
    $_SESSION['ft_name'] = null;
    $_SESSION['fi_lastname'] = null;
    $_SESSION['name'] = null;
    $_SESSION['nickname'] = null;
    $_SESSION['email'] = null;
    $_SESSION['photo'] = null;
    $_SESSION['role_id'] = null;
    $_SESSION['admin'] = null;
    $_SESSION['adminLimit'] = null;
    $_SESSION['cliente'] = null;
    $_SESSION['empleado'] = null;
    $_SESSION['user_id'] = null;

    header('Location: ../../../views/auth/login.php');
?>