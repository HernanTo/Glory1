<?php
    include('../auth/security/securityGeneral.php');
    include ('../../model/cotizaciones.php');
    $Cotizacion = new Cotizaciones;

    list($data, $product, $seller) = $Cotizacion->generateBill($_GET['referencia']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización | Lotus</title>
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

            if(mysqli_num_rows($data) > 0){
                foreach($data as $row){
                    
        ?>

        <div class="container-general">
            <div class="container-index-user conrtainer-table-d">
                <div class="header-table">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Cotizaciones</a>
                        /
                        <a><?php echo $_GET['referencia'] ?></a>
                    </div>
                    <h2>Resumen Cotización</h2>
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
                                <h3><?php echo $row['num_fact'] ?></h3>
                                <img src="../../assets/img/icons/hastag 2.svg" alt="">
                            </span>

                            <span>
                                <label>Fecha</label>
                                <h3><?php echo $row['date'] ?></h3>
                                <img src="../../assets/img/icons/calendar 1.svg" alt="">
                            </span>

                            <span>
                                <label>Código de barras</label>
                                <h3><?php echo $row['num_fact'] ?></h3>
                                <img src="../../assets/img/icons/barcode-read 2.svg" alt="">
                            </span>

                            <span>
                                <label>Descuento</label>
                                <h3>No aplica</h3>
                                <img src="../../assets/img/icons/badge-percent 1.svg" alt="">
                            </span>
                            
                            <span>
                                <label>Subtotal</label>
                                <h3 class="prices"><?php echo $row['subtotal'] ?></h3>
                                <img src="../../assets/img/icons/usd-circle 1.svg" alt="">
                            </span>

                            <span>
                                <label>Total</label>
                                <h3 class="prices"><?php echo $row['total_prices'] ?></h3>
                                <img src="../../assets/img/icons/hand-holding-usd 1.svg" alt="">
                            </span>
                        </div>
                    </div>
                    <div class="actions-bill">
                        <a href="./generate_cotizacion_pdf.php?referencia=<?php echo $_GET['referencia'] ?>" class="export-document" target="_blank" rel="noopener noreferrer"><img src="../../assets/img/icons/file-export 1.svg" alt=""></a>

                        <a href="./generate_cotizacion_excel.php?referencia=<?php echo $_GET['referencia'] ?>" class="export-document export__excel" target="_blank" rel="noopener noreferrer"><img src="../../assets/img/icons/file-excel.svg" alt=""></a>

                        <a href="" class="edit-bill"><img src="../../assets/img/icons/edit 1.svg" alt=""></a>

                        <button class="delete-bill"><img src="../../assets/img/icons/delete-document 1.svg" alt=""></button>
                    </div>

                    <div class="con-items-bill-s con-items-min con-items-cli">
                        <div class="header-items-s">
                            <h2>Cliente</h2>
                            <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-clien-sum">
                            <p><?php echo $row['fullname'] ?></p>
                            <p><?php echo $row['phone'] ?></p>
                            <p><?php echo $row['email'] ?></p>
                            <p><?php echo $row['address'] ?></p>
                            <a href="../user/user.php?cc=<?php echo $row['cedula'] ?>" class="action-user-sum">Ver Cliente</a>
                        </div>
                    </div>

                    <?php
                        foreach($seller as $fila){
                            ?>
                            <div class="con-items-bill-s con-items-min con-items-seller">
                                <div class="header-items-s">
                                    <h2>Vendedor</h2>
                                    <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                                </div>
                                <div class="body-items-sum body-seller-sum">
                                    <img src="../../assets/img/profilePictures/<?php echo $fila['photo'] ?>" alt="">
                                    <h2><?php echo $row['nameLas'] ?></h2>
                                    <a href="../user//user.php?cc=<?php echo $row['cedula'] ?>" class="action-user-sum">Ver Más</a>
                                </div>
                            </div>
                            <?php
                        }
                    ?>

                    <div class="con-items-bill-s con-item-order-s">
                        <div class="header-items-s">
                            <h2>Orden</h2>
                            <img src="../../assets/img/icons/box-open 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-order-sum">
                            <?php
                                foreach($product as $dat){
                                    if($dat['stock'] == 0){
                                        $stock = 'No';
                                    }else{
                                        $stock = 'Si';
                                        
                                    }

                                    ?>
                                    <div class="product-su">
                                        <img src="../../assets/img/products/<?php echo $dat['photo'] ?>" alt="product">
                                        <h2><?php echo $dat['name_product'] ?></h2>
                                        <h4 class="prices"><?php echo $dat['price_u'] ?></h4>

                                        <p class="cantidad-prod-s">Cantidad: <i><?php echo $dat['amount'] ?></i></p>

                                        <h1 class="prices prices-pro"><?php echo $dat['prices_total'] ?></h1>

                                        <p class="mano-obra-su">Stock: <i><?php echo $stock ?></i></p>
                                    </div>
                                    <?php
                                }
                            ?>
                            
                            <div class="con-sum-prices">
                                <p>Descuento</p>
                                <h5>No Aplica</h5>

                                <p>Subtotal</p>
                                <h2 class="prices"><?php echo $row['subtotal'] ?></h2>

                                <p>IVA</p>
                                <h2 class="prices"><?php echo $row['subtotal'] * 0.19 ?></h2>

                                <p>Total:</p>
                                <h2 class="prices"><?php echo $row['total_prices']?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
    <!-- Modal -->

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/indexbill.js"></script>
    <!-- scripts main -->
</body>
</html>