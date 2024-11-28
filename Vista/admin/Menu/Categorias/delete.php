<?php

require '../../config/config2.php';

require '../../config/config.php';

require '../../config/Database.php';

$db = new Database2();
$con = $db->conectar();


$id = $_GET['id'];

$sql = $con->prepare("SELECT id_categoria,nombre_categoria 
FROM categoria WHERE id_categoria = ? AND activo_categoria=1");
$sql->execute([$id]);
$categoria = $sql->fetch(PDO::FETCH_ASSOC);

?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php'?>


<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Elimina categoria </h1>
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
                            

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="col">
                                <div class="col-md-12">

                                    <form action="../../config/controladores/categorias/elimina_categoria.php"  method="post" autocomplete="off">

                                    <input type="hidden" name="id_categoria" value="<?php echo $categoria['id_categoria']; ?>">


                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">Nombre:</label>
                                                            <input type="text" id="nombre" name="nombre"  value="<?php echo $categoria['nombre_categoria']?>"class="form-control" required maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>
                                             
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <a href="categorias.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit"  value="Eliminar Categoria" class="btn btn-danger">Eliminar Categoria</button>
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

