<?php 
    include('../auth/security/securityGeneral.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <!-- Css page -->

</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
        ?>

        <div class="container-general">
            <div class="container-dash">
                <div class="header-page-g">
                    <div class="bread-cump">
                        <a>Home</a>
                        /
                        <a>Dashboard</a>
                    </div>
                    <span></span>
                    <div class="con__add_item__dash con__add_product">
                        <a href="../product/add-product.php">Nueva producto</a>
                    </div>
                    <div class="con__add_item__dash con__add_bill">
                        <a href="../bill/add-bill.php">Nuevo Factura</a>
                    </div>
                </div>
                <div class="card_dash" id="card_gan">
                    <span class="h__card_dash">
                        <h2><span>$</span>69.700</h2>
                        <div class="progress__dash progress_dash__up"><img src="../../assets/img/icons/arrow-trend-up.svg" alt="up">2.2%</div>
                        <label>Ganancias del mes</label>
                    </span>
                    <span class="b__card_dash">
                        <img src="../../assets/img/temp.png" alt="">
                    </span>
                </div>
                <div class="con-items-bill-s con-items-fact" id="item__ventas__mes">
                    <div class="header-items-s">
                        <h2>Ventas este mes</h2>
                        <img src="../../assets/img/icons/barsvg.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">

                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="item__ventas__stock">
                    <div class="header-items-s">
                        <h2>Productos poco stock</h2>
                        <img src="../../assets/img/icons/warehouse-alt.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">
                        <div class="prod__low_st">
                            <div class="con__table con__table__prod_low_st">
                                <table>
                                    <tr>
                                        <th style="text-align: left;">Producto</th>
                                        <th></th>
                                        <th style="min-width: 100px;">Precio</th>
                                        <th style="min-width: 100px;">Stock</th>
                                    </tr>
                                    <tbody>
                                        <tr class="row_prod_ls">
                                            <td><img src="https://proyectoshernan.online/lotus/assets/img/products/7832product.jpg" alt="product" class="img__prod_lows"></td>
                                            <td class="name__prod_ls">Parrilla Frontal Glory 580 <label><img src="../../assets/img/icons/barcode-read 2.svg" alt="barcode">172723</label></td>
                                            <td class="prices">10000</td>
                                            <td class="stock__prod_ls">5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="fact_est">
                    <div class="header-items-s">
                        <h2>Facturas</h2>
                        <img src="../../assets/img/icons/barsvg.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">

                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="fact_pend">
                    <div class="header-items-s">
                        <h2>Facturas pendientes</h2>
                        <img src="../../assets/img/icons/barsvg.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <!-- scripts main -->
    <script>
          function formatCurrency(number) {
            if (isNaN(number)) {
            return "Invalid number";
            }
            let formattedNumber = new Intl.NumberFormat("es-CO").format(number);
            formattedNumber = `$${formattedNumber}`;

            return formattedNumber;
        }
        let prices = document.querySelectorAll('.prices');
        for (let i = 0; i < prices.length; i++) {
        let precio = prices[i].textContent;
            $(prices[i]).empty();
            prices[i].appendChild(document.createTextNode(formatCurrency(precio)));
        }
    </script>
</body>
</html>