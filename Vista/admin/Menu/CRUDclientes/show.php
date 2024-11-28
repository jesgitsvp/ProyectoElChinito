<?php
require '../../config/config2.php';
require '../../config/config.php';
require '../../config/Database.php';

$db = new Database2();
$con = $db->conectar();
//
$id = $_GET['id'];

//
$sql = $con ->prepare("SELECT nombres, apellidos,correo,telefono, ciudad, provincia, direccion,dni FROM cliente WHERE idCliente=? AND estatus=1");
$sql -> execute([$id]);
$cliente = $sql ->fetch(PDO::FETCH_ASSOC);
//
//
$sql_usuario = $con->prepare("SELECT * FROM usuario_cliente WHERE id_cliente = ?");
$sql_usuario->execute([$id]);
$datos_usuario = $sql_usuario->fetch(PDO::FETCH_ASSOC);

//
$sql_ventas = $con->prepare("SELECT COUNT(*) AS total_ventas FROM venta WHERE id_cliente = ?");
$sql_ventas->execute([$id]);
$result_ventas = $sql_ventas->fetch(PDO::FETCH_ASSOC);

$total_ventas = $result_ventas['total_ventas'];




include  ('../parte1.php'); 

?>


<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Cliente <?php echo $id; ?></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <a href="clientes.php" class="boton-retroceso">
                                            <img src="izquierda.png" alt="Retroceder">
                                        </a>
                                    </div>
                                </div>

                                 
                                    
                                <div class="content">
                                    <div class="container-fluid" style="font-size: 12px">
                                        
                                        <hr>

                                        <div style="display: flex">
                                            <h5 style="margin:10px">Datos Cliente: </h5>
                                        </div>

                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Nombre </label>
                                                    <input type="text" value="<?php echo $cliente['nombres'] . ' ' . $cliente['apellidos']; ?>" id="nombre_cliente" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Ciudad</label>
                                                    <input type="text" value="<?php echo $cliente['ciudad'];?> "id="ciudad" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Teléfono</label>
                                                    <input type="number" value="<?php echo $cliente['telefono'];?>" id="telefono" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">DNI </label>
                                                    <input type="number" value="<?php echo $cliente['dni'];?>" id="dni" class="form-control" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" value="<?php echo $cliente['correo'];?>" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <input type="text" value="<?php echo $cliente['direccion'];?>" id="direccion" cols="30" rows="3" class="form-control" disabled> 
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                    

                                

                                    
                                    <hr>            

                                    <div style="display: flex">
                                        <h5 style="margin:10px">Datos Usuario: </h5>
                                    </div>
                                    
                                    <hr>

                                    <div class="container-fluid" style="font-size: 12px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="id_cliente" hidden>
                                                    <label for="">Nombre </label>
                                                    <input type="text" value="<?php echo $datos_usuario['usuario']; ?>" id="usuario_cliente" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Usuario activado</label>
                                                    <input type="text" value="<?php echo $datos_usuario['activacion'] == 1 ? 'Sí' : 'No'; ?>" id="activo" class="form-control" disabled>
                                                    </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="compras" hidden>
                                                    <label for="">Compras realizadas </label>
                                                    <input type="text" value="<?php echo $total_ventas; ?>" id="total_ventas" class="form-control" disabled>

                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                        </div>        
                    </div>    
                </div>
            </div>
        </div>
    </div>
  

<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Productos",
                "infoEmpty": "Mostrando 0 a 0 de 0 Productos",
                "infoFiltered": "(Filtrado de _MAX_ total Productos)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Productos",
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

<?php include ('../parte2.php'); ?>