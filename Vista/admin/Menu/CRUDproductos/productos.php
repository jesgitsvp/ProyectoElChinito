<?php

require '../../config/config2.php';
require '../../config/config.php';

include ('../../config/controladores/productos/listado_producto.php');

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
                    <h1 class="m-0">Listado de Productos
                    <a href="nuevo_productos.php">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                    </button></a>
                    </h1>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Productos registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                           <div class="table table-responsive">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                   <tr>
                                       <th><center>Nro</center></th>
                                       <th><center>Categoría</center></th>
                                       <th><center>Nombre</center></th>
                                       <th><center>Stock</center></th>
                                       <th><center>Precio compra</center></th>
                                       <th><center>Precio Venta</center></th>
                                       <th><center>Acciones</center></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        <?php $contador = 0; ?>
                                        <?php foreach($productos_datos as $producto_dato){?>
                                            <tr>
                                                <td><center><?php echo $contador = $contador + 1;?></center></td>
                                                <td><center><?php echo $producto_dato['NombreCategoria'];?></center></td>
                                                <td><center><?php echo $producto_dato['Nombre']?></center></td>
                                                <td><center><?php echo $producto_dato['Existencias']?></center></td>
                                                <td><center><?php echo $producto_dato['Costo']?></center></td>
                                                <td><center><?php echo $producto_dato['PrecioVenta']?></center></td>
                                                 <td><center>
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $producto_dato['idProducto'] ?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                                        <a href="update.php?id=<?php echo $producto_dato['idProducto']?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                        <a href="delete.php?id=<?php echo $producto_dato['idProducto']?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td></center>
                                            </tr>
                                       <?php } ?>
                                     </tbody>
                                   </tfoot>
                               </table>
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
            "pageLength": 7,
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

