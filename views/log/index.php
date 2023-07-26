<?php
    include('../auth/security/securityGeneral.php');
    if($_SESSION['role_id'] != '1' && $_SESSION['role_id'] != '4'){
        header('Location: ../cuenta/logs.php');
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos | Lotus</title>
    <link rel="shortcut icon " href="../../assets/img/icons/lotus.svg" />
    <!-- ** Main Css -->
    <link rel="stylesheet" href="../../libs/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/main.css">
    <link rel="stylesheet" href="../../css/component.css">
    <!-- ** Main Css -->
    <!-- Css page -->
    <link rel="stylesheet" href="../../css/logs.css">
    <link rel="stylesheet" href="../../libs/datatable/datatables.min.css">
    <!-- Css page -->

</head>
<body>
    <div class="con-main-general">
        <?php
            include('../templates/navbar.php');
            include('../templates/sidebar.php');
            $data = $Log->indexM($_SESSION['role_id']);
        ?>

        <div class="container-general">
            <div class="container-index-user conrtainer-table-d">
                <div class="header-table">
                    <div class="bread-cump">
                        <a href="../dashboard/">Home</a>
                        /
                        <a>Logs</a>
                    </div>
                    <h2>Logs</h2>
                        <div class="con-filter">
                            <p>Tipo Accion: </p>
                            <div class="con-filter-da"></div>
                            <div class="divider-fil"></div>
                        </div>
                </div>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                            <th>Desc</th>
                            <th>Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if(mysqli_num_rows($data) > 0){
                                while($row = $data->fetch_assoc()){
                                    if($row['type'] == '1'){
                                        $action = '<div class="action-logs edit"> Editar</div>';
                                    }else if($row['type'] == '2'){
                                        $action = '<div class="action-logs nuevo"> Crear</div>';
                                    }else if($row['type'] == '3'){
                                        $action = '<div class="action-logs eliminar"> Eliminar</div>';
                                    }else if($row['type'] == '4'){
                                        $action = '<div class="action-logs error"> Error</div>';
                                    }
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                        <td><?php echo $action ?></td>
                                        <td><?php echo $row['descr']?></td>
                                        <td><a href="../user/user.php?cc=<?php echo $row['cedula']?>" class="user-g-log"><img src="../../assets/img/profilePictures/<?php echo $row['photo'] ?>" alt=""><h2><?php echo $row['name_user'] ?></h2></a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>

                    </tbody>

                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Accion</th>
                            <th>Desc</th>
                            <th>Usuario</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <!-- scripts main -->
    <script src="../../libs/bootstrap/jquery.js"></script>
    <script src="../../libs/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="../js/sidebar.js"></script>
    <script src="../../libs/datatable/datatables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#example').DataTable({
                responsive: true,
                "order": [[ 1, "desc" ]],
                "columns": [
                    { "width": "5%" },
                    { "width": "25%"},
                    {"width": "15%"},
                    null,
                    null
                ],
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
    <!-- scripts main -->
</body>
</html>