<?php
    include('../auth/security/securityGeneral.php');
    include ('../../model/bill.php');
    include ('../../model/service.php');
    $Bill = new Bill;
    $Service = new Service;

    list($data, $product, $seller) = $Bill->generateBill($_GET['referencia']);
    $descuento = 0;
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

            if(mysqli_num_rows($data) > 0){
                foreach($data as $row){
                    $services = $Service->index($row['id_bill']);
                    
        ?>

        <div class="container-general">
            <div class="container-index-user conrtainer-table-d">
                <div class="header-table">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Facturas</a>
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
                                <h3><?php echo $row['num_fact'] ?></h3>
                                <img src="../../assets/img/icons/hastag 2.svg" alt="">
                            </span>

                            <span>
                                <label>Fecha</label>
                                <h3><?php echo $row['date'] ?></h3>
                                <img src="../../assets/img/icons/calendar 1.svg" alt="">
                            </span>

                            <span>
                                <label>Estado de pago</label>
                                <h3><?php echo $row['state_page'] == 'true' ? 'Pagada' : 'Sin pago'; ?></h3>
                                <img src="../../assets/img/icons/hands-usd.svg" alt="">
                            </span>

                            <span>
                                <label>Descuento</label>
                                
                                <h3 class="<?php echo intval($row['descuento']) == 0 ? 'd' : 'prices'; ?>"><?php echo $row['descuento'] == 0 ? 'No aplica' : $row['descuento']; ?></h3>
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
                        <a href="./generate_bill_pdf.php?referencia=<?php echo $_GET['referencia'] ?>" class="export-document" target="_blank" rel="noopener noreferrer" title="Generar PDF"><img src="../../assets/img/icons/file-export 1.svg" alt=""></a>

                        <a href="" class="edit-bill" title="Editar Factura"><img src="../../assets/img/icons/edit 1.svg" alt=""></a>

                        <button class="delete-bill" title="Eliminar factura"><img src="../../assets/img/icons/delete-document 1.svg" alt=""></button>
                    </div>

                    <div class="con-items-bill-s con-items-min con-items-cli">
                        <div class="header-items-s">
                            <h2>Cliente</h2>
                            <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                        </div>
                        <div class="body-items-sum body-clien-sum">
                            <p><?php echo $row['fullname'] ?></p>
                            <p>Tel: <?php echo $row['phone'] ?></p>
                            <p>Email: <?php echo $row['email'] ?></p>
                            <a href="../user/user.php?cc=<?php echo $row['cedula'] ?>" class="action-user-sum">Ver Cliente</a>
                        </div>
                    </div>

                    <?php
                        foreach($seller as $filas){
                            
                            ?>
                            <div class="con-items-bill-s con-items-min con-items-seller">
                                <div class="header-items-s">
                                    <h2>Vendedor</h2>
                                    <img src="../../assets/img/icons/user-crown 1.svg" alt="">
                                </div>
                                <div class="body-items-sum body-seller-sum">
                                    <img src="../../assets/img/profilePictures/<?php echo $filas['photo'] ?>" alt="">
                                    <h2><?php echo $filas['nameLas'] ?></h2>
                                    <a href="../user/user.php?cc=<?php echo $filas['cedula'] ?>" class="action-user-sum">Ver Más</a>
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
                            <h2 class="hed__prod_or">Productos</h2>
                            <?php
                                if(mysqli_num_rows($product) >= 1){
                                    foreach($product as $dat){
                                        $descuento = 0;
                                        $descuento = $descuento + $dat['descuento'];
                                        if($dat['mano_obra'] == '0'){
                                            $manoObra = 'No aplica';
                                        }else{
                                            $manoObra = $dat['prices_mano_obra'];
                                        }
    
                                        ?>
                                        <div class="product-su">
                                            <img src="../../assets/img/products/<?php echo $dat['photo'] ?>" alt="product">
                                            <h2><?php echo $dat['name_product'] ?></h2>
                                            <h4 class="prices"><?php echo $dat['price_u'] ?></h4>
    
                                            <p class="cantidad-prod-s">Cantidad: <i><?php echo $dat['amount'] ?></i></p>
                                            <p class="mano-obra-su">Mano de obra: <i class="<?php echo $manoObra != 'No aplica' ? 'prices' : '' ?>"><?php echo $manoObra ?></i></p>
    
                                            <h1 class="prices prices-pro"><?php echo $dat['prices_total'] ?></h1>
                                        </div>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <div class="product_no">
                                            <h2 class="h2_not_product">Esta factura no cuenta con productos adjuntos</h2>
                                        </div>
                                    <?php
                                }
                            ?>
                            <div class="con__sum__services">
                                <h2>Servicios</h2>
                                <?php
                                    if(mysqli_num_rows($services) >= 1){
                                        foreach($services as $service){
                                            ?>
                                            <div class="serv">
                                                <h3><?php echo $service['detail'] ?></h3>
                                                <h5 class="prices prices-pro"><?php echo $service['price'] ?></h5>
                                            </div>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                        <div class="serv serv_no">
                                            <h2>Esta factura no cuenta con servicios adjuntos</h2>
                                        </div>
                                        <?php
                                    }
                                ?>
                            </div>
                            
                            <div class="con-sum-prices">
                                <?php 
                                    

                                    if($row['iva'] == 'false'){
                                        $iva = 'No Aplica';
                                    }else{
                                        $iva = $row['subtotal'] * 0.19;
                                    }
                                ?>
                                <p>Descuento</p>
                                <h5 class="<?php echo $row['descuento'] == 0 ? 'd' : 'prices'; ?>"><?php echo $row['descuento'] == 0 ? 'No aplica' : $row['descuento']; ?></h5>

                                <p>Subtotal</p>
                                <h2 class="prices"><?php echo $row['subtotal'] ?></h2>

                                <p>IVA</p>
                                <h2 class="<?php echo $iva == 'No Aplica' ? 'd' : 'prices'; ?>"><?php echo $iva ?></h2>

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
    ?>
    <!-- Modal -->

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script>
          function formatCurrency(number) {
            if (isNaN(number)) {
            return "Invalid number";
            }
            let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
            formattedNumber = `$${formattedNumber}`;

            return formattedNumber;
        }
    </script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/indexbill.js"></script>
    <!-- scripts main -->
</body>
</html>