<?php
    include('../auth/security/securityGeneral.php');
    require ('../../model/user.php');
    require ('../../model/role.php');
    $User = new User;
    $data = $User->index();

    $Role = new Role;
    $dataRole = $Role->index();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios | Lotus</title>
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
                        <a><?php echo $_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 7 ? 'Clientes' :'Usuarios'  ?></a>
                    </div>
                    <h2><?php echo $_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 7 ? 'Clientes' :'Usuarios'  ?></h2>
                        <div class="con-filter">
                            <button class="btn-modal-add">
                                <img src="../../assets/img/icons/plus.svg" alt="">
                                Nuevo <?php echo $_SESSION['role_id'] == 6 || $_SESSION['role_id'] == 7 ? 'clientes' :'usuarios'  ?>
                            </button>
                            <p>Filtrar por rol: </p>
                            <div class="con-filter-da"></div>
                            <div class="divider-fil"></div>
                        </div>
                </div>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Rol</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            while($row = $data->fetch_assoc()){
                                if($row['role_id'] == 1){
                                    $role = "Administrador";
                                }elseif($row['role_id'] == 4){
                                    $role = "Gerente";
                                }elseif($row['role_id'] == 5){
                                    $role = "Cliente";
                                }elseif($row['role_id'] == 6){
                                    $role = "Empleado";
                                }
                                $nombre = $row['nombres'];
                                ?>
                                <tr>
                                    <td><?php echo $row['cedula'] ?></td>
                                    <td><?php echo $row['nombres'] ?></td>
                                    <td><?php echo $role ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td class="con-actions-table">
                                        <a href="./user.php?cc=<?php echo $row['cedula'] ?>" class="actions-table"><img src="../../assets/img/icons/eye.svg" alt=""></a>
                                        <a href="./edit.php?cc=<?php echo $row['cedula'] ?>" class="actions-table"><img src="../../assets/img/icons/pencil.svg" alt=""></a>
                                        <a onclick="confirmTrash(<?php echo $row['id'] ?>, '<?php echo $nombre ?>')" class="actions-table"><img src="../../assets/img/icons/trash-xmark.svg" alt=""></a>
                                   </td>
                                </tr>
                                <?php
                            }
                        ?>
                    </tbody>

                    <tfoot>
                        <tr>
                            <th>Documento</th>
                            <th>Nombres</th>
                            <th>Rol</th>
                            <th>Email</th>
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
    <script src="../js/user.js"></script>
    <script src="../js/adduser.js"></script>

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
                },  
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

        if(isset($_SESSION['editUser'])){
            if($_SESSION['editUser']){
                ?>
                <script>
                    notiuseradd = document.getElementById('notiedituser');
                    toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                <?php
                unset($_SESSION['editUser']);
            }
        }
        
        if(isset($_SESSION['userDelete'])){
            if($_SESSION['userDelete']){
                ?>
                <script>
                    notiuseradd = document.getElementById('notideleteuser');
                    toastBootstrap = bootstrap.Toast.getOrCreateInstance(notiuseradd)
                    toastBootstrap.show();
                </script>
                <?php
                unset($_SESSION['userDelete']);
            }
        }
    ?>
    <!-- scripts main -->
</body>
</html>