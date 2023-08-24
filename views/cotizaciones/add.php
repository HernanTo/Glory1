<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/user.php');
    require ('../../model/product.php');
    require ('../../model/cotizaciones.php');
    require ('../../model/role.php');

    $Role = new Role;
    $dataRole = $Role->index();

    $User = new User;
    $customers = $User->searchRol(5);
    $seller = $User->searchRol(6);

    $Product = new Product;
    $products = $Product->index();

    $Cotizaciones = new Cotizaciones;
    
    $numsBill = $Cotizaciones->numBills();
    $referencia = generateNumReferences($numsBill);


    function verBillNumBill($bill, $num){
        $estado = false;

        foreach($bill as $referencia){
            if($referencia['num_fact'] == $num){
                $estado = true;
            }
        }

        return $estado;
    }

    function generateNumReferences($numsBill){
        if(mysqli_num_rows($numsBill) > 0){
            $num = rand(00000000, 99999999);
            while(verBillNumBill($numsBill, $num)){
                $num = rand(00000000, 99999999);
            }
            
        }else{
            $num = rand(00000000, 99999999);
        }

        return $num;
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva cotización | Lotus</title>
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
                        <a href="../cotizaciones/">Cotizaciones</a>
                        /
                        <a>Nueva Cotización</a>
                    </div>
                    <h2><img src="../../assets/img/icons/square-plus.svg" alt=""> 
                        Nueva Cotización</h2>
                </div>
                <form action="../../controller/cotizaciones.php?action=store" method="post" id="form-bill">
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Información básica de la cotización</h3>
                        <img src="../../assets/img/icons/info.svg" alt="">
                    </div>
                    <div class="form-floating">
                        <input type="date" class="form-control date-input" id="date_bill" placeholder="Fecha" name="date_bill" required="">
                        <label for="floatingInputValue">Fecha</label>
                    </div>
                    <div class="form-floating">
                        <input type="number" class="form-control" id="references" placeholder="Referencia" name="reference" value="<?php echo $referencia ?>" required>
                        <label for="floatingInputValue">Referencia</label>
                        <img src="../../assets/img/icons/notebook.svg" alt="" class="ico-in">
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
                    <label for="">Vendedor:</label>
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

                        </form>
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
                        <h3>Artículos de la cotización</h3>
                        <img src="../../assets/img/icons/shopping-bag-add.svg" alt="">
                    </div>
                    <div class="con-product-ord">
                        <div class="not-pro-ord">
                            <img src="../../assets/img/icons/plus.svg" alt="">
                            <p>Agregue productos</p>
                        </div>
                    </div>

                </section>
                <br>
                <section class="sect-form-p sect-form-up">
                    <div class="divider-form">
                        <h3>Información</h3>
                        <img src="../../assets/img/icons/usd-circle.svg" alt="">
                    </div>
                    <div class="resumen-orden">
                        <div class="info-fact">
                            <h3>IVA: </h3>
                            <p>19%</p>
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
    <script src="../js/add-cotiza.js"></script>
    <!-- scripts main -->
    <script>
        $(document).ready(function() {
            $('#customers').select2({
                placeholder: "Selecciona un cliente",
                allowClear: true
            });

            $('#seller').select2({
                placeholder: "Selecciona el vendedor",
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
    ?>
</body>
</html>