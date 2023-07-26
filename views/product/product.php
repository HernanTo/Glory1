<?php
    include('../auth/security/securityGeneral.php');
    // if($_SESSION['role_id'] != 1 || $_SESSION['role_id'] == 4){
    //     header('Location: ./');
    // }

    include('../../model/Product.php');

    $Product = new Product;
    if(isset($_GET['id'])){
        if($_GET['id'] == ''){
            header('Location: ./');
        }else{
            $dataProduct = $Product->searchProduct($_GET['id']);
        }
    }else{
        header('Location: ./');
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Producto | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/account.css">
    <link rel="stylesheet" href="../../css/viewProduct.css">
    <!-- Css page -->

</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
            if(mysqli_num_rows($dataProduct) > 0){
            foreach($dataProduct as $row){
                $nombre = $row['name_product'];
        ?>

        <div class="container-general">
            <div class="container-index-user con-acount-general">
                <div class="header-page-g">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Productos</a>
                        /
                        <a><?php echo $row['name_product'] ?></a>
                    </div>
                </div>
                <div class="container-product-v">
                    <div class="con-prod">
                        <div class="con-info-basic-prd">
                            <h2><?php echo $row['name_product'] ?></h2>
                            <p class="prices"><?php  echo $row['prices'] ?></p>
                        </div>
                        <div class="con-img-produ">
                            <img src="../../assets/img/products/<?php  echo $row['photo'] ?>" alt="producto">
                        </div>
                        <div class="con-categories-v">
                            <h6>Categorias:</h6>
                            <?php
                                $Product->showCategoryP($row['id']);
                            ?>
                        </div>

                        <div class="con-datas-prod">
                        <div class="con-data-prod">
                            <div class="header-data-prod">Acerca de</div>
                            <div class="body-data-prod">
                                <span>
                                    <img src="../../assets/img/icons/hastag.svg" alt="">
                                    <p>Repuesto</p>
                                    <h5><?php  echo $row['num_repuesto'] ?></h5>
                                </span>
                                <span>
                                    <img src="../../assets/img/icons/barcode-read.svg" alt="">
                                    <p>Código de barras</p>
                                    <h5><?php  echo $row['Barcode'] ?></h5>
                                </span>
                                <span>
                                    <p style="grid-column: 1/3; margin: 0px">Estado</p>
                                    <h5><?php  echo $row['state'] == 1 ? 'Activo' : 'Inactivo' ?></h5>
                                </span>
                                

                            </div>
                        </div>

                        <div class="con-data-prod">
                            <div class="header-data-prod">Stock</div>
                            <div class="body-data-prod">
                                <span>
                                    <img src="../../assets/img/icons/truck-loading.svg" alt="">
                                    <p>Stock actual</p>
                                    <h5><?php  echo $row['amount'] ?></h5>
                                </span>
                                <span>
                                    <img src="../../assets/img/icons/box-open-full.svg" alt="">
                                    <p>Stock máximo</p>
                                    <h5><?php  echo $row['max_stock'] ?></h5>
                                </span>
                                <span>
                                    <img src="../../assets/img/icons/box-open.svg" alt="">
                                    <p>Stock Mínimo</p>
                                    <h5><?php  echo intval($row['max_stock'] * 0.15) ?></h5>
                                </span>
                            </div>
                        </div>
                        </div>

                        <div class="con-actions-pro-v">
                            <?php
                                if($_SESSION['role_id'] == 1 || $_SESSION['role_id'] == 4){
                                    ?>
                                        <a href="./edit.php?id=<?php  echo $row['id'] ?>">Editar</a>
                                        <button onclick="confirmTrash(<?php echo $row['id'] ?>, '<?php echo $nombre ?>')">Eliminar</button>
                                        <?php
                                }else{
                                    ?>
                                        <a href="./">Volver</a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-table-product">
                    <table>
                        <tr>
                            <th>Código de barras</th>
                            <th># Repuesto</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Stock Actual</th>
                            <th>Stock Máxmio</th>
                            <th>Estado</th>
                        </tr>
                        <tbody>
                            <tr>
                                <td class="con-barcode-prodc" style="min-width: 200px;"><img alt='Barcode Generator TEC-IT' src='https://barcode.tec-it.com/barcode.ashx?data=<?php echo $row['Barcode'] ?>&code=Code25IL'/></td>
                                <td style="min-width: 110px;"><?php  echo $row['num_repuesto'] ?></td>
                                <td  style="min-width: 110px;"><?php  echo $row['name_product'] ?></td>
                                <td  style="min-width: 110px;" class="prices"><?php  echo $row['prices'] ?></td>
                                <td  style="min-width: 110px;"><?php  echo $row['amount'] ?></td>
                                <td style="min-width: 110px;"><?php  echo $row['max_stock'] ?></td>
                                <td style="min-width: 110px;"><?php  echo $row['state'] == 1 ? 'Activo' : 'Inactivo' ?></td>
                            </tr>
                        </tbody>
                    </table>
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
    <script src="../js/indexprod.js"></script>
    <!-- scripts main -->
</body>
</html>