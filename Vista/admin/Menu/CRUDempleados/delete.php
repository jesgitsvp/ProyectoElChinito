<?php

require '../../config/config2.php';

require '../../config/config.php';

require '../../config/Database.php';


$db = new Database2();
$con = $db->conectar();


$id = $_GET['id'];

$sql = $con->prepare("SELECT idEmpleado,Nombre,Apellido,Cargo,Telefono,Correo,dni,salario 
FROM empleado WHERE idEmpleado = ? AND activo=1");
$sql->execute([$id]);
$empleado = $sql->fetch(PDO::FETCH_ASSOC);

?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Eliminar empleado</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="col">
                                <div class="col-md-12">

                                    <form action="../../config/controladores/empleados/elimina_empleado.php"  method="post" autocomplete="off">

                                    <input type="hidden" name="idEmpleado" value="<?php echo $empleado['idEmpleado']; ?>">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">Nombre:</label>
                                                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $empleado['Nombre'] ?>"  maxlength="50" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="apellido" class="form-label">Apellido:</label>
                                                            <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $empleado['Apellido'] ?>"  maxlength="50" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="correo" class="form-label" >Correo:</label>
                                                            <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $empleado['Correo'] ?>" readonly >
                                                        </div>
                                                    </div>
                                                </div>   

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="cargo" class="form-label">Cargo:</label>
                                                            <input type="text" id="cargo" name="cargo" class="form-control"value="<?php echo $empleado['Cargo'] ?>" readonly maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono" class="form-label" >Telefono:</label>
                                                            <input type="number" id="telefono" name="telefono" class="form-control" value="<?php echo $empleado['Telefono'] ?>" readonly >
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="dni" class="form-label" >DNI:</label>
                                                            <input type="number" id="dni" name="dni" class="form-control" value="<?php echo $empleado['dni'] ?>" readonly >
                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="salario" class="form-label" >Salario:</label>
                                                            <input type="number" id="salario" name="salario" class="form-control" value="<?php echo $empleado['salario'] ?>" readonly >
                                                        </div>
                                                    </div>
                                                </div>  

                                            </div>
                                        


                                             
                                        </div>





                                        <hr>
                                        <div class="form-group">
                                            <a href="empleados.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit"  value="Guardar Empleado" class="btn btn-danger">Eliminar Empleado</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<?php include ('../parte2.php'); ?>
<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>




<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

