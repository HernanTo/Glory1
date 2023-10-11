<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/user.php');
    require ('../../model/product.php');
    require ('../../model/bill.php');
    require ('../../model/role.php');
    
    $Role = new Role;
    $dataRole = $Role->index();

    $User = new User;
    $Product = new Product;
    $Bill = new Bill;
    $customers = $User->searchRol(5);
    $seller = $User->searchRol(6,1);
    $products = $Product->indexBill();

    $numsBill = $Bill->numBills();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Factura | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/selects/select2.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/add-product.css">    
    <link rel="stylesheet" href="../../css/add-bill.css">    
    <!-- Css page -->

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
                        <a href="../bill/">Factura</a>
                        /
                        <a>Nueva factura</a>
                    </div>
                    <h2><img src="../../assets/img/icons/square-plus.svg" alt=""> 
                        Nueva factura</h2>
                </div>
                <form action="../../controller/bill.php?action=store" method="post" id="form-bill">
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Información básica de la factura</h3>
                        <img src="../../assets/img/icons/info.svg" alt="">
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control date-input" id="date_bill" placeholder="Fecha" name="date_bill" required>
                        <label for="floatingInputValue">Fecha</label>
                    </div>
                    <div class="con-select-s">
                        <label for="">Cliente:</label>
                        <select name="customer" id="customers">
                            <option value=""></option>
                            <?php
                                while ($row = $customers->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row['id'] ?>">(<?php echo $row['cedula'] ?>) <?php echo $row['nombres'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <div class="input-add-user-bill" id="btn-add-customer"><img src="../../assets/img/icons/plus.svg" alt=""> Añadir</div>

                    </div>
                    <div class="con-select-s">
                    <label for="">Técnico / Vendedor:</label>
                        <select name="seller" id="seller">
                            <option value=""></option>
                        <?php
                                while ($row = $seller->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row['id'] ?>">(<?php echo $row['cedula'] ?>) <?php echo $row['nombres'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <div class="input-add-user-bill" id="btn-add-seller"><img src="../../assets/img/icons/plus.svg" alt=""> Añadir</div>
                    </div>
                    <div class="con-select-s">
                    <label for="">Lista de productos:</label>
                        <select name="products" id="products">
                            <option value=""></option>
                        <?php
                                while ($row = $products->fetch_assoc()){
                                    ?>
                                        <option value="<?php echo $row['id_product'] ?>" data-price="<?php echo $row['prices'] ?>" data-amount="<?php echo $row['amount'] ?>" data-img="<?php echo $row['photo'] ?>" data-barcode="<?php echo $row['Barcode'] ?>">(<?php echo $row['Barcode'] ?>) <?php echo $row['name_product'] ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                        <a href="../product/add-product.php" class="input-add-user-bill"><img src="../../assets/img/icons/plus.svg" alt=""> Añadir</a>

                        <div class="alert alert-warning" role="alert" style="margin-top: 20px; display: none;" id="alert-prod-ag">
                            El producto seleccionado, ya fue agregado
                        </div>
                    </div>
                </section>
                <br>
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Artículos de la Orden</h3>
                        <img src="../../assets/img/icons/shopping-bag-add.svg" alt="">
                    </div>
                    <div class="con-product-ord">
                        <div class="not-pro-ord" id="not-pro-ord">
                            <img src="../../assets/img/icons/plusb.svg" alt="">
                            <p>Agregue productos</p>
                        </div>
                    </div>

                </section>
                <br>
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Servicios</h3>
                        <img src="../../assets/img/icons/tools.svg" alt="">
                    </div>
                    <div class="con-serv-ord">
                        <div class="inser-serv">
                            <label>Ingresar</label>
                            <input type="number" id="can_serv_insert">
                            <label>Servicios</label>

                            <input type="button" value="Insertar" id="btn-inser-serv">
                        </div>
                        <div class="con-sev" id="con-sev">
                            <div class="not-pro-ord not__ser_ord" id="add-serv">
                                <img src="../../assets/img/icons/plusB.svg" alt="">
                                <p>Agregue servicios</p>
                            </div>
                        </div>
                    </div>
                </section>
                </form>
                <br>
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Configuración</h3>
                        <img src="../../assets/img/icons/usd-circle.svg" alt="">
                    </div>
                    <div class="resumen-orden">
                        <div class="info-fact">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="iva__check" checked>
                                <label class="form-check-label" for="iva__check">IVA</label>
                            </div>
                        </div>
                        <div class="info-fact">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="estado__pago_check">
                                <label class="form-check-label" for="estado__pago_check">Estado de pago</label>
                            </div>
                        </div>
                    </div>
                </section>
                <br><br>
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Resumen</h3>
                        <img src="../../assets/img/icons/ticket.svg" alt="">
                    </div>
                    <div class="resumen-orden">
                        <div class="info-fact">
                            <h3>IVA: </h3>
                            <p id="iva_info">$0</p>
                        </div>
                        <div class="info-fact">
                            <h3>Estado: </h3>
                            <p id="estado__pago">Pendiente de pago</p>
                        </div>
                        <div class="info-fact">
                            <h3>Subtotal: </h3>
                            <p class="con-sub-t" id="con-sub-t">$0</p>
                        </div>
                        <div class="info-fact">
                            <h3>Total: </h3>
                            <p class="con-t" id="con-t">$0</p>
                        </div>
                    </div>
                </section>
                <section class="foo-add-u">
                            <button type="button" class="btn-sub-bill btn-disabled" disabled>Crear</button>
                            <a href="./index.php">Volver</a>
                </section>
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
    <!-- <script src="../../libs/bootstrap/jquery-ui.js"></script> -->
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../../libs/selects/select2.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/adduser.js"></script>

    <script src="../js/add-bill.js"></script>
    <!-- scripts main -->
    <script>
        $(document).ready(function() {
            $('#customers').select2({
                placeholder: "Selecciona un cliente",
                allowClear: true
            });

            $('#seller').select2({
                placeholder: "Selecciona al técnico / vendedor",
                allowClear: true
            });
            $('#products').select2({
                placeholder: "Selecciona los productos"
            });
        });
    </script>
<?php
        if(isset($_SESSION['user-add'])){
            if($_SESSION['user-add']){
                ?>
                <script>
                    let notiuseradd = document.getElementById('notiuseradd');
                    const toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                <?php
                unset($_SESSION['user-add']);
            }
        }
        if(isset($_SESSION['err_bill'])){
            if($_SESSION['err_bill']){
                $err = json_encode($_SESSION['err_bill']);
                ?>
                <script>
                    errModalStock('<?php echo $err ?>')
                </script>
                <?php
                unset($_SESSION['err_bill']);
            }
        }
    ?>
</body>
</html>