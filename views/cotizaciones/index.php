<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/cotizaciones.php');
    $Cotizaciones = new Cotizaciones;
    $data = $Cotizaciones->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotizaciones | Lotus</title>
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
                        <a>Cotizaciones</a>
                    </div>
                    <h2>Cotizaciones</h2>
                        <div class="con-filter">
                            <a href="./add.php" class="btn-modal-add" style="text-decoration: none;">
                                <img src="../../assets/img/icons/plus.svg" alt="">
                                Cotizar
                            </a>
                            <p>Fechas: </p>
                            <div class="con-filter-da"></div>
                            <div class="divider-fil"></div>
                        </div>
                </div>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Número de cotizacion</th>
                            <th>Fecha</th>
                            <th>Total</th>
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
                                        <td><?php echo $row['num_fact'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td class="prices"><?php echo $row['total_prices'] ?></td>
                                        <td><?php echo $row['name_cliente'] ?></td>
                                        <td class="con-actions-table">
                                            <a href="./cotizacion.php?referencia=<?php echo $row['num_fact'] ?>" class="actions-table"><img src="../../assets/img/icons/eye.svg" alt=""></a>
                                            <a href="../../controller/user.php?action=edit&id=<?php echo $row['id_bill'] ?>" class="actions-table"><img src="../../assets/img/icons/pencil.svg" alt=""></a>
                                            <a onclick="confirmTrash(<?php echo $row['id_bill'] ?>, '<?php echo $row['num_fact'] ?>')" class="actions-table"><img src="../../assets/img/icons/trash-xmark.svg" alt=""></a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Número de cotizacion</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Cliente</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
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
                            columns: [ 0, 1,2,3]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [ 0, 1,2,3]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                ],    
                initComplete: function () {
                this.api().columns([ 1 ]).every( function () {
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

        if(isset($_SESSION['bill_delete'])){
            if($_SESSION['bill_delete']){
                ?>
                <script>
                    notiuseradd = document.getElementById('notibilldelete');
                    toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                
                <?php
                unset($_SESSION['bill_delete']);
            }
        }
    ?>
    <!-- scripts main -->
</body>
</html>