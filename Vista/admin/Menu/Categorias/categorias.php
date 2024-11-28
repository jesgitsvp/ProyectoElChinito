<?php

require '../../config/config2.php';
require '../../config/config.php';

include ('../../config/controladores/categorias/listado_categoria.php');

?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php'?>

<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-12">
                  <h1 class="m-0">Listado de Categorías
                    <a href="nueva_categoria.php">
                      <button type="button" class="btn btn-primary" >
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
                          <h3 class="card-title">Categorías registradas</h3>
                          <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                              </button>
                          </div>
                      </div>

                      <div class="card-body" style="display: block;">
                          <table id="example1" class="table table-bordered table-striped">
                              <thead>
                              <tr>
                                  <th><center>Nro</center></th>
                                  <th><center>Nombre de la categoría</center></th>
                                  <th><center>Acciones</center></th>
                              </tr>
                              </thead>
                              <tbody>
                                <?php
                                $contador = 0;
                                foreach ($categorias_datos as $categorias_dato){
                                    $id_categoria = $categorias_dato['id_categoria'];
                                    $nombre_categoria = $categorias_dato['nombre_categoria']; ?>
                                    <tr>
                                        <td><center><?php echo $contador = $contador + 1;?></center></td>
                                        <td><center><?php echo $categorias_dato['nombre_categoria'];?></center></td>
                                                <td><center>
                                                    <div class="btn-group">
                                                        <a href="delete.php?id=<?php echo $categorias_dato['id_categoria']?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td></center>
                                        
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                          </table>
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

<?php include '../parte2.php'?>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Categorías",
                "infoEmpty": "Mostrando 0 a 0 de 0 Categorías",
                "infoFiltered": "(Filtrado de _MAX_ total Categorías)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Categorías",
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



<script>
    $('#btn_create').click(function () {
        var nombre_categoria = $('#nombre_categoria').val();

        if(nombre_categoria == ""){
            $('#nombre_categoria').focus();
            $('#lbl_create').css('display','block');
        } else {
            var url = "../../config/controladores/categorias/registro_categoria.php";
            $.get(url, {nombre_categoria:nombre_categoria}, function (datos) {
                $('#respuesta').html(datos);
            });
        }
    });
</script>
<div id="respuesta"></div>
<script src="../menu.js"></script>

</body>
</html>
