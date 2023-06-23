<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/product.php');
    $Product = new Product;
    $data = $Product->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../libs/datatable/datatables.min.css">
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
                        <a>Productos</a>
                    </div>
                    <h2>Productos</h2>
                        <div class="con-filter">
                            <a href="./add-product.php" class="btn-modal-add" style="text-decoration: none;">
                                <img src="../../assets/img/icons/plus.svg" alt="">
                                Nuevo producto
                            </a>
                            <p>Categorías: </p>
                            <div class="con-filter-da"></div>
                            <div class="divider-fil"></div>
                        </div>
                </div>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Barras</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(mysqli_num_rows($data) > 0){
                                while($row = $data->fetch_assoc()){
                                    $nombre = $row['name_product'];
                                    ?>
                                    <tr>
                                        <td><?php echo $row['Barcode'] ?></td>
                                        <td><?php echo $row['name_product'] ?></td>
                                        <td><?php echo $row['category'] ?></td>
                                        <td class="prices"><?php echo $row['prices']?></td>
                                        <td><?php echo $row['amount'] ?></td>
                                        <td class="con-actions-table">
                                            <a href="../../controller/user.php?action=edit&id=<?php echo $row['id_product'] ?>" class="actions-table"><img src="../../assets/img/icons/pencil.svg" alt=""></a>
                                            <a onclick="confirmTrash(<?php echo $row['id_product'] ?>, '<?php echo $nombre ?>')" class="actions-table"><img src="../../assets/img/icons/trash-xmark.svg" alt=""></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Barras</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
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
    <script src="../js/indexprod.js"></script>
    <script src="../../libs/datatable/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true,
                initComplete: function () {
                this.api().columns([ 2 ]).every( function () {
                var column = this;
                var select = $('<select class="form-select form-select-sm selecttable-lotus"> <option value="">Todos</option> </select>')
                .appendTo( $('.con-filter-da'))
                .on( 'change', function () {
                    var val = $.fn.dataTable.util.escapeRegex(
                        $(this).val()
                    );
                    column
                        .search( val ? '^'+val+'$' : '', true, false )
                        .draw();
                } );

                column.data().unique().sort().each( function ( d, j ) {
                    if(column.search() === '^'+d+'$'){
                        select.append(
                            '<option value="'+d+'" selected="selected">'
                            +d+
                            '</option>'
                        )
                    } else {
                        select.append('<option value="'+d+'">'+d+'</option>')
                    }
                });
            });
            }
            });
        });
    </script>


    <?php
        if(isset($_SESSION['newProduct'])){
            if($_SESSION['newProduct']){
                ?>
                <script>
                    let notiuseradd = document.getElementById('notiprodadd');
                    let toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                <?php
                unset($_SESSION['newProduct']);
            }
        }

        if(isset($_SESSION['deleteProduct'])){
            if($_SESSION['deleteProduct']){
                ?>
                <script>
                    notiuseradd = document.getElementById('notiprodelete');
                    toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                
                <?php
                unset($_SESSION['deleteProduct']);
            }
        }
    ?>
    <!-- scripts main -->
</body>
</html>