<?php
    include('../auth/security/securityGeneral.php');
    include('../../model/category.php');
    include('../../model/Product.php');

    $Category = new Category;
    $dataCategory = $Category->index();

        if($_SESSION['role_id'] != 1 || $_SESSION['role_id'] == 4){
        header('Location: ./');
    }


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
    <title>Editar producto | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/selects/select2.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/editProduct.css">    
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
            <div class="container-index-user conrtainer-table-d">
                <div class="header-table">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a href="./">Productos</a>
                        /
                        <a href="./product.php?id=<?php echo $row['id'] ?>"><?php echo $row['name_product'] ?></a>
                        /
                        <a>Editar</a>
                    </div>
                    <h2><img src="../../assets/img/icons/pen-circleg.svg" alt=""> 
                        Editar producto</h2>
                </div>
                <div class="container-forr">
                    <form action="../../controller/product.php?action=edit" method="post" class="con-sect-a-p" enctype="multipart/form-data">
                        <input type="number" name="id" class="id" value="<?php echo $row['id'] ?>" style="display: none">
                        <section class="sect-form-p sect-form-up">
                            <div class="divider-form">
                                <h3>Editar información básica del producto</h3>
                                <img src="../../assets/img/icons/info.svg" alt="">
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nombre producto" name="name_product" value="<?php echo $row['name_product'] ?>" required>
                                <label for="floatingInput">Nombre producto</label>
                                <img src="../../assets/img/icons/box-open.svg" alt="" class="ico-in">
                            </div>
                            <div class="con-categ">
                                <select class="form-select" id="category" name="category[]" multiple="multiple" required>
                                    <?php
                                        $categorySelected = $Product->CategoryP($row['id']);
                                        $count = 0;
                                            foreach($dataCategory as $category){
                                                if($category['id'] == $categorySelected[0]){
                                                    ?><option value="<?php echo $category['id'] ?>" selected><?php echo $category['category'] ?></option><?php

                                                }elseif(isset($categorySelected[1])){
                                                    if($category['id'] == $categorySelected[1]){
                                                        ?><option value="<?php echo $category['id'] ?>" selected><?php echo $category['category'] ?></option><?php
                                                    }else{
                                                        ?><option value="<?php echo $category['id'] ?>"><?php echo $category['category'] ?></option><?php
                                                    }
                                                }else{
                                                    ?><option value="<?php echo $category['id'] ?>"><?php echo $category['category'] ?></option><?php
                                                }
                                            }
                                    ?>
                                </select>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Número de repuesto" name="num_repuesto"  value="<?php echo $row['num_repuesto'] ?>" required>
                                <label for="floatingInput">Número de repuesto</label>
                                <img src="../../assets/img/icons/hastag.svg" alt="" class="ico-in">
                            </div>
                            
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Código de barras" name="barcode"  value="<?php echo $row['Barcode'] ?>" required>
                                <label for="floatingInput">Código de barras</label>
                                <img src="../../assets/img/icons/barcode-read.svg" alt="" class="ico-in">
                            </div>
                            <div class="container-picture-prod">
                                <div>
                                    <label>Imagen del producto</label>
                                </div>
                                <div class="con-picture">
                                    <img src="../../assets/img/products/<?php  echo $row['photo'] ?>" alt="producto" class="img-product" id="img-product">
                                    <div class="trash-pic" id="trash-pic" title="Eliminar imagen"> <img src="../../assets/img/icons/broom.svg" alt=""></div>
                                        <label for="photo_product" class="edit-picture-profi"  title="Editar imagen"><img src="../../assets/img/icons/pen-circle.svg" alt=""></label>
                                        <input type="file" name="photo_product" id="photo_product" style="display: none" accept="image/png,image/jpeg">
                                        <input type="number" name="changepicturestate" value="0" id="changepicturestate" style="display: none;"> 
                                </div>
                            </div>
                        </section>

                        <section class="sect-form-p sect-form-down">
                            <div class="divider-form">
                                <h3>Editar información de inventario 
                                    </h3>
                                    <img src="../../assets/img/icons/rectangle-list.svg" alt="">
                            </div>
                            <div class="form-floating">
                                <input type="text" class="form-control" placeholder="Precio por unidad" name="price_product" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" data-type="currency" required  value="<?php echo $row['prices'] ?>">
                                <label for="floatingInput">Precio por unidad</label>
                                <img src="../../assets/img/icons/dollar.svg" alt="" class="ico-in">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad de stock"  name="stock" onkeydown="return event.keyCode !== 69" required  value="<?php echo $row['amount'] ?>">
                                <label for="floatingInput">Cantidad de stock</label>
                                <img src="../../assets/img/icons/truck-loading.svg" alt="" class="ico-in">
                            </div>
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="floatingInput" placeholder="Cantidad de stock"  name="max_stock" onkeydown="return event.keyCode !== 69" required  value="<?php echo $row['max_stock'] ?>">
                                <label for="floatingInput">Cantidad de stock máxima</label>
                                <img src="../../assets/img/icons/box-open-full.svg" alt="" class="ico-in">
                            </div>
                        </section>

                        <section class="foo-add-u">
                            <button type="submit">Editar</button>
                            <a href="./product.php?id=<?php echo $row['id'] ?>">Volver</a>
                        </section>
                    </form>
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
        ?>
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
    <script src="../js/editproduct.js"></script>

    <script>
        $(document).ready(function() {
            $('#category').select2({
                placeholder: "Selecciona una o varias categorias",
                multiple: true,
                maximumSelectionLength: 2,
                allowClear: true
            });
        });
    </script>
    <!-- scripts main -->
</body>
</html>