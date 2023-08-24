<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/category.php');

    $Category = new Category;
    $data = $Category->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo producto | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/selects/select2.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/add-product.css">    
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
                        <a href="../product/">Productos</a>
                        /
                        <a>Nuevo producto</a>
                    </div>
                    <h2><img src="../../assets/img/icons/square-plus.svg" alt=""> 
                        Nuevo producto</h2>
                </div>
                <div class="container-forr">
                    <form action="../../controller/product.php?action=store" method="post" class="con-sect-a-p" enctype="multipart/form-data">
                        <section class="sect-form-p sect-form-up">
                            <div class="divider-form">
                                <h3>Información básica del producto</h3>
                                <img src="../../assets/img/icons/info.svg" alt="">
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nombre producto" name="name_product" required>
                                <label for="floatingInput">Nombre producto</label>
                                <img src="../../assets/img/icons/box-open.svg" alt="" class="ico-in">
                            </div>
                            <div class="con-categ">
                                <select class="form-select" id="category" name="category[]" multiple="multiple" required>
                                    <option value=""></option>
                                    <?php
                                        while($row = $data->fetch_assoc()){
                                            ?><option value="<?php echo $row['id'] ?>"><?php echo $row['category'] ?></option><?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Número de repuesto" name="num_repuesto" required>
                                <label for="floatingInput">Número de repuesto</label>
                                <img src="../../assets/img/icons/hastag.svg" alt="" class="ico-in">
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Código de barras" name="barcode" required>
                                <label for="floatingInput">Código de barras</label>
                                <img src="../../assets/img/icons/barcode-read.svg" alt="" class="ico-in">
                            </div>

                            <div class="input-group-file">
                                <label for="photo_product" class="con-lab">
                                    <div class="ico-inpt-file"><img src="../../assets/img/icons/upload.svg" alt=""></div>
                                    <div class="text-inpt-f" id="name_picture_prod">Seleccione la imagen</div>
                                </label>
                                <input type="file" id="photo_product" style="display: none" accept="image/png,image/jpeg" name="photoProduct">
                            </div>
                        </section>

                        <section class="sect-form-p sect-form-down">
                            <div class="divider-form">
                                <h3>Información de inventario 
                                    </h3>
                                    <img src="../../assets/img/icons/rectangle-list.svg" alt="">
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Precio por unidad" name="price_product" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" required>
                                <label for="floatingInput">Precio por unidad</label>
                                <img src="../../assets/img/icons/dollar.svg" alt="" class="ico-in">
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Precio por unidad" name="product_cost" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" required>
                                <label for="floatingInput">Costo por unidad</label>
                                <img src="../../assets/img/icons/dollar.svg" alt="" class="ico-in">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad de stock"  name="stock" onkeydown="return event.keyCode !== 69" required>
                                <label for="floatingInput">Cantidad de stock</label>
                                <img src="../../assets/img/icons/truck-loading.svg" alt="" class="ico-in">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad de stock"  name="min_stock" onkeydown="return event.keyCode !== 69" required>
                                <label for="floatingInput">Cantidad minima de stock</label>
                                <img src="../../assets/img/icons/box-open-full.svg" alt="" class="ico-in">
                            </div>
                        </section>

                        <section class="foo-add-u">
                            <button type="submit">Crear</button>
                            <a href="./index.php">Volver</a>
                        </section>
                    </form>
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
    <script src="../../libs/selects/select2.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../js/add-product.js"></script>

    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: "Selecciona una categoria",
                multiple: true,
                maximumSelectionLength: 1,
                allowClear: true
            });
        });
    </script>
    <!-- scripts main -->
</body>
</html>