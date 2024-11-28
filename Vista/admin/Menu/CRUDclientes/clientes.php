<?php

require '../../config/config2.php';
require '../../config/config.php';

include ('../../config/controladores/clientes/listado_cliente.php');

include  ('../parte1.php'); 


?>


<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Clientes
                        
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
                            <h3 class="card-title">Clientes registrados</h3>
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
                                    <th><center>Nombres</center></th>
                                    <th><center>Celular</center></th>
                                    <th><center>DNI</center></th>
                                    <th><center>Email</center></th>
                                    <th><center>Ciudad</center></th>
                                    <th><center>Provincia</center></th>
                                    <th><center>Direccion</center></th>
                                    <th><center>Acciones</center></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        <?php $contador = 0; ?>
                                        <?php foreach($clientes_datos as $cliente_dato){?>
                                            <tr>
                                                <td><center><?php echo $contador = $contador + 1;?></center></td>
                                                <td><center><?php echo $cliente_dato['nombres']. ' ' . $cliente_dato['apellidos'];?></center></td>
                                                <td><center><?php echo $cliente_dato['telefono']?></center></td>
                                                <td><center><?php echo $cliente_dato['dni']?></center></td>
                                                <td><center><?php echo $cliente_dato['correo']?></center></td>
                                                <td><center><?php echo $cliente_dato['ciudad']?></center></td>
                                                <td><center><?php echo $cliente_dato['provincia']?></center></td>
                                                <td><center><?php echo $cliente_dato['direccion']?></center></td>
                                                 <td><center>
                                                    <div class="btn-group">
                                                        <a href="show.php?id=<?php echo $cliente_dato['idCliente']?>" type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> </a>
                                                        <a href="update.php?id=<?php echo $cliente_dato['idCliente']?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                        <a href="delete.php?id=<?php echo $cliente_dato['idCliente']?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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

<?php include ('../parte2.php'); ?>
<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>



<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Clientes",
                "infoEmpty": "Mostrando 0 a 0 de 0 Clientes",
                "infoFiltered": "(Filtrado de _MAX_ total Clientes)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Clientes",
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
