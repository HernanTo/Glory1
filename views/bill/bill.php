<?php
    include('../auth/security/securityGeneral.php');
    include ('../../model/bill.php');
    $Bill = new Bill;

    list($data, $product) = $Bill->generateBill($_GET['referencia']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturas | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->

    <link rel="stylesheet" href="../../css/bill.css">
</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
        ?>

        <div class="container-general">
            <div class="container-index-user conrtainer-table-d">
                <div class="header-table">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="../bill/">Facturas</a>
                        /
                        <a><?php echo $_GET['referencia'] ?></a>
                    </div>
                    <h2>Resumen factura</h2>
                </div>
                <div class="con-bill-summary">
                    <div class="con-items-bill-s con-items-fact">
                        <div class="header-items-s">
                            <h2>Factura</h2>
                            <img src="../../assets/img/icons/receipt 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-items-fact">
                            <span>
                                <label>Número de factura</label>
                                <h3>456545456</h3>
                                <img src="../../assets/img/icons/hastag 2.svg" alt="">
                            </span>

                            <span>
                                <label>Fecha</label>
                                <h3>25-08-2023</h3>
                                <img src="../../assets/img/icons/calendar 1.svg" alt="">
                            </span>

                            <span>
                                <label>Código de barras</label>
                                <h3>3233223</h3>
                                <img src="../../assets/img/icons/barcode-read 2.svg" alt="">
                            </span>

                            <span>
                                <label>Descuento</label>
                                <h3>No aplica</h3>
                                <img src="../../assets/img/icons/badge-percent 1.svg" alt="">
                            </span>
                            
                            <span>
                                <label>Subtotal</label>
                                <h3 class="prices">2000</h3>
                                <img src="../../assets/img/icons/usd-circle 1.svg" alt="">
                            </span>

                            <span>
                                <label>Total</label>
                                <h3 class="prices">3000</h3>
                                <img src="../../assets/img/icons/hand-holding-usd 1.svg" alt="">
                            </span>
                        </div>
                    </div>
                    <div class="actions-bill">
                        <button class="export-document"><img src="../../assets/img/icons/file-export 1.svg" alt=""></button>

                        <a href="" class="edit-bill"><img src="../../assets/img/icons/edit 1.svg" alt=""></a>

                        <button class="delete-bill"><img src="../../assets/img/icons/delete-document 1.svg" alt=""></button>
                    </div>

                    <div class="con-items-bill-s con-items-min con-items-cli">
                        <div class="header-items-s">
                            <h2>Cliente</h2>
                            <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-clien-sum">
                            <p>Juan Diego Mejia</p>
                            <p>3132093326</p>
                            <p>juandi@gmail.com</p>
                            <p>Kra 10B #13-56 Oeste</p>
                            <a href="../user/" class="action-user-sum">Ver Cliente</a>
                        </div>
                    </div>

                    <div class="con-items-bill-s con-items-min con-items-seller">
                        <div class="header-items-s">
                            <h2>Vendedor</h2>
                            <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-seller-sum">
                            <img src="../../assets/img/profilePictures/default.png" alt="">
                            <h2>Juan Pedro</h2>
                            <a href="../user/" class="action-user-sum">Ver Más</a>
                        </div>
                    </div>

                    <div class="con-items-bill-s con-item-order-s">
                        <div class="header-items-s">
                            <h2>Orden</h2>
                            <img src="../../assets/img/icons/box-open 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-order-sum">
                            <div class="product-su">
                                <img src="../../assets/img/products/default.png" alt="product">
                                <h2>Motor Hidráulico 8 válvulas</h2>
                                <h4 class="prices">22000</h4>

                                <p class="cantidad-prod-s">Cantidad: <i>10</i></p>
                                <p class="mano-obra-su">Mano de obra: <i>No aplica</i></p>

                                <h1 class="prices prices-pro">10000</h1>
                            </div>
                            

                            <div class="con-sum-prices">
                                <p>Descuento</p>
                                <h5>No Aplica</h5>

                                <p>Subtotal</p>
                                <h2 class="prices">2.000</h2>

                                <p>IVA</p>
                                <h2 class="prices">3000</h2>

                                <p>Total:</p>
                                <h2 class="prices">10000</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <?php
        include('./components/modal.php');
    ?>
    <!-- Modal -->

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/indexbill.js"></script>
    <!-- scripts main -->
</body>
</html>