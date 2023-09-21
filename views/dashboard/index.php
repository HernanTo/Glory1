<?php 
    include('../auth/security/securityGeneral.php');
    include('../../model/report.php');
    $Report = new report;
    $Report->ganancias('09', '2023');
    $BillNoP = $Report->billNoP();
    list($dates, $total) = $Report->ventasMes('09', '2023', '20');
    $factState = $Report->fact('09', '2023');
    list($ganancias, $ganaciasCategoriasF) = $Report->ganancias('09', '2023');
    $lowStock = $Report->lowStock();
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
                        <h2 class="prices"><?php echo $ganancias ?></h2>
                        <div class="progress__dash progress_dash__up"><img src="../../assets/img/icons/arrow-trend-up.svg" alt="up">2.2%</div>
                        <label>Ganancias del mes</label>
                    </span>
                    <span class="b__card_dash">
                        <canvas id="chartCategories" class="charts_dash"></canvas> 
                    </span>
                </div>
                <div class="con-items-bill-s con-items-fact" id="item__ventas__mes">
                    <div class="header-items-s">
                        <h2>Ventas este mes</h2>
                        <img src="../../assets/img/icons/barsvg.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">
                    <canvas id="chartMonth" class="charts_month"></canvas> 
                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="item__ventas__stock">
                    <div class="header-items-s">
                        <h2>Productos poco stock</h2>
                        <a href="" class="src__card">Ver Productos</a>
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
                                        <?php
                                            foreach($lowStock as $row){
                                                ?>
                                                <tr class="row_prod_ls">
                                                    <td><img src="../../assets/img/products/<?php echo $row['photo'] ?>" alt="product" class="img__prod_lows"></td>
                                                    <td class="name__prod_ls"><a href="../product/product.php?id=<?php echo $row['id'] ?>"><?php echo $row['name_product'] ?></a> <label><img src="../../assets/img/icons/barcode-read 2.svg" alt="barcode"><?php echo $row['Barcode'] ?></label></td>
                                                    <td class="prices"><?php echo $row['prices'] ?></td>
                                                    <td class="stock__prod_ls"><?php echo $row['amount'] ?></td>
                                                </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="fact_est">
                    <div class="header-items-s">
                        <h2>Facturas</h2>
                        <img src="../../assets/img/icons/chart-pie-alt.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact">
                        <canvas id="chartFact" class="charts_dash"></canvas> 
                    </div>
                </div>
                <div class="con-items-bill-s con-items-fact" id="fact_pend">
                    <div class="header-items-s">
                        <h2>Facturas pendientes</h2>
                        <img src="../../assets/img/icons/hands-usd.svg" alt="">
                    </div>
                    <div class="body-items-sum body-items-fact body-items-fact__pend">
                        <?php
                            foreach($BillNoP as $row){
                                ?>
                                <div class="bill_p">
                                    <div class="info__sup__bill">
                                        <span class="num__refe__bill_p"># <?php echo $row['num_fact'] ?></span>
                                        <span class="name__clikent_bill_p"><?php echo $row['nameLas'] ?></span>
                                        <span class="prices"><?php echo $row['total_prices'] ?></span>
                                        <span class="name__clikent_bill_p date__bill_p"><?php echo $row['date'] ?></span>
                                    </div>
                                    <div class="state__bill"></div>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../../libs/chart.js/chart.js"></script>
    <script src="https://unpkg.com/chartjs-plugin-colorschemes"></script>
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
    <script>
         $(document).ready(function () {
            //<< Chart ganancias del mes
                let gananciasCategory = <?php echo json_encode($ganaciasCategoriasF); ?>;
                let labelCategory = [];
                let dataCategory = [];
                gananciasCategory.forEach(element => {
                    labelCategory.push(element['nameCategory']);
                    dataCategory.push(element['ganancia']);
                });
                let data = {
                    labels: labelCategory,
                    datasets: [{
                        label: 'Ganancias por categorias',
                        data: dataCategory,
                        borderWidth: 0
                    }]
                }

                let config = {
                    type: 'doughnut',
                    data,
                    options: {
                        responsive: 'true',
                        aspectRatio: null,
                        plugins: {
                            legend: {
                                position: 'right'
                            },
                        },
                        layout:{
                            padding: 0
                        }
                    }
                }
                let chartGanancias = new Chart(document.getElementById('chartCategories'), config);
            // Chart ganancias del mes >>

            // Char bill state
                // Setup 
                let billState = <?php echo json_encode($factState); ?>;

                data = {
                    labels: ['Pagadas', 'No pagas'],
                    datasets: [{
                        label: 'Estado de las facturas',
                        data: billState,
                        borderWidth: 0
                    }]
                }
                // Config block
                config = {
                    type: 'polarArea',
                    data,
                    options: {
                        responsive: 'true',
                        aspectRatio: null,
                        plugins: {
                            legend: {
                                position: 'right'
                            }
                        },
                        layout:{
                            padding: 0
                        }
                    }
                }
                // render block
                let chartBillState = new Chart(document.getElementById('chartFact'), config);

            // Char bill state

            // Char ventas mes
                // Setup 
                let datesMonth = <?php echo json_encode($dates); ?>;
                let salesMonth = <?php echo json_encode($total); ?>;

                data = {
                    labels: datesMonth,
                    datasets: [{
                        label: 'Ventas diarias',
                        data: salesMonth,
                        pointRadius: 10,
                        pointHoverRadius: 15
                    }]
                }
                // Config block
                config = {
                    type: 'line',
                    data,
                    options: {
                        responsive: 'true',
                        // aspectRatio: null,
                        // maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            }
                        },
                        layout:{
                            padding: 0, 
                        }
                    }
                }
                // render block
                let chartMoth = new Chart(document.getElementById('chartMonth'), config);

            // Char ventas mes
         });
        </script>
</body>
</html>