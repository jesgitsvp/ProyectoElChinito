<?php
require '../../config/config2.php';
require '../../config/config.php';
require '../../config/Database.php';

$db = new Database2();
$con = $db->conectar();
//
$id = $_GET['id'];
//
$sql = $con ->prepare("SELECT id_producto, nombre,precio,cantidad FROM detalleventa WHERE id_venta=? AND activo=1");
$sql -> execute([$id]);
$productos = $sql ->fetchAll(PDO::FETCH_ASSOC);
//
$id_cliente = $_GET['id_cliente'];
//
$sql_cliente = $con->prepare("SELECT * FROM cliente WHERE idCliente = ?");
$sql_cliente->execute([$id_cliente]);
$datos_cliente = $sql_cliente->fetch(PDO::FETCH_ASSOC);



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
                    <h1 class="m-0">Venta nro <?php echo $id; ?></h1>
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
                            <div class="card card-danger">
                                <div class="card-header">
                                    <h3 class="card-title">Datos de la venta</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                        </button>
                                        <a href="ventas.php" class="boton-retroceso">
                                            <img src="izquierda.png" alt="Retroceder">
                                        </a>
                                    </div>

                                </div>

                                <div class="card-body" style="display: block;">
                                    <div class="row" style="font-size: 12px">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="table table-responsive">
                                <table id="example1" class="table table-bordered table-striped table-sm">
                                    <thead>
                                    <tr>
                                        <th><center>Nro</center></th>
                                        <th><center>Nombre</center></th>
                                        <th><center>Precio</center></th>
                                        <th><center>Cantidad</center></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php $contador = 0; ?>
                                        <?php foreach($productos as $producto){?>
                                            <tr>
                                                <td><center><?php echo $contador = $contador + 1;?></center></td>
                                                <td><center><?php echo $producto['nombre']?></center></td>
                                                <td><center><?php echo $producto['precio']?></center></td>
                                                <td><center><?php echo $producto['cantidad']?></center></td>
                                            </tr>
                                       <?php } ?>
                                     </tbody>
                                    </tfoot>
                                </table>
                            </div>
 
                                            </div>






                                        </div>

                                    </div>

                                    <hr>
                                    <div style="display: flex">
                                        <h5>Datos del cliente </h5>
                                    </div>
                                    <hr>

                                    <div class="container-fluid" style="font-size: 12px">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" id="id_cliente" hidden>
                                                    <label for="">Nombre </label>
                                                    <input type="text" value="<?php echo $datos_cliente['nombres'] . ' ' . $datos_cliente['apellidos']; ?>" id="nombre_cliente" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Ciudad</label>
                                                    <input type="text" value="<?php echo $datos_cliente['ciudad'];?> "id="ciudad" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Teléfono</label>
                                                    <input type="number" value="<?php echo $datos_cliente['telefono'];?>" id="telefono" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">DNI </label>
                                                    <input type="number" value="<?php echo $datos_cliente['dni'];?>" id="number" class="form-control" disabled>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" value="<?php echo $datos_cliente['correo'];?>" id="email" class="form-control" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Dirección</label>
                                                    <input type="text" value="<?php echo $datos_cliente['direccion'];?>" id="direccion" cols="30" rows="3" class="form-control" disabled> 
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