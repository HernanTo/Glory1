<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/service.php');
    require ('../../model/role.php');
    $Service = new Service;
    $data = $Service->index();

    $Role = new Role;
    $dataRole = $Role->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicios | Lotus</title>
    <link rel="shortcut icon" href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../libs/datatable/datatables.min.css">
    <link rel="stylesheet" href="../../libs/datatable/datatablesButtons.css">
    
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
                        <a>Servicios</a>
                    </div>
                    <h2>Servicios</h2>
                        <div class="con-filter">
                            <a href="./add.php" class="btn-modal-add" style="text-decoration: none;">
                                <img src="../../assets/img/icons/plus.svg" alt="">
                                Nuevo Servicio
                            </a>
                            <div class="con-filter-da"></div>
                            <div class="divider-fil"></div>
                        </div>
                </div>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Referencia</th>
                            <th>Detalle</th>
                            <th>Precio</th>
                            <th>Cliente</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(mysqli_num_rows($data) > 0){
                                while($row = $data->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $row['referencia'] ?></td>
                                        <td><?php echo $row['detail'] ?></td>
                                        <td><?php echo $row['price']?></td>
                                        <td><?php echo $row['cliente'] ?></td>
                                        <td class="con-actions-table">
                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Referencia</th>
                            <th>Detalle</th>
                            <th>Precio</th>
                            <th>Cliente</th>
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
    <script src="../../libs/datatable/datatablesButtons.js"></script>
    <script src="../../libs/datatable/jszip.min.js"></script>
    <script src="../../libs/datatable/pdfmake.min.js"></script>
    <script src="../../libs/datatable/vfs_fonts.js"></script>
    <script src="../../libs/datatable/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true,
                dom: 'Bfrtip',
                lengthMenu: [
                    [ 25, 50, 100, -1 ],
                    [ '25', '50', '100', 'Mostrar todo' ]
                ],
                buttons: [
                    'pageLength',
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4 ]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4 ]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3,4 ]
                        }
                    },
                ],    
            });
        });
    </script>

    <!-- scripts main -->
</body>
</html>