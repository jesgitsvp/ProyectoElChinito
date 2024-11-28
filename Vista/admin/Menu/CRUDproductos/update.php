<?php

require '../../config/config2.php';

require '../../config/config.php';

require '../../config/Database.php';


include ('../../config/controladores/categorias/listado_categoria.php');


$db = new Database2();
$con = $db->conectar();


$id = $_GET['id'];

$sql = $con->prepare("SELECT idProducto,Nombre,Descripcion,idCategoria,Costo,PrecioVenta,descuento,Existencias,InvMinimo,InvMaximo,fchaactualizacion 
FROM producto WHERE idProducto = ? AND activo=1");
$sql->execute([$id]);
$producto = $sql->fetch(PDO::FETCH_ASSOC);

$rutaImagenes = '../../../../img/productos/'. $id .'/';
$imagenPrincipal = $rutaImagenes . 'principal.jpg';

$imagenes = [];
$dirInit = dir($rutaImagenes);

while(($archivo = $dirInit -> read()) !== false){
    if($archivo != 'principal.jpg' && (strpos($archivo,'jpg') || strpos($archivo,'jpeg') )){
        $image=$rutaImagenes . $archivo;
        $imagenes[]=$image;

    }
}

$dirInit->close();

?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php'?>

<style>
    .ck-editor__editable[role="textbox"]{
        min-height: 250px;
    }
</style>


<script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Modifica producto</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="col">
                                <div class="col-md-12">

                                    <form action="../../config/controladores/productos/edita_producto.php" enctype="multipart/form-data" method="post" autocomplete="off">

                                    <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="categoria" class="form-label">Categoría:</label>
                                                            <div style="display: flex">
                                                                <select type="text" id="categoria" name="categoria" class="form-control" >
                                                                    <option value=""> Seleccionar </option>
                                                                    <?php foreach($categorias_datos as $categoria_dato) { ?>
                                                                        <option value="<?php echo $categoria_dato['id_categoria'];?>"<?php if($categoria_dato['id_categoria'] == $producto['idCategoria']) echo 'selected'; ?>><?php echo $categoria_dato['nombre_categoria']; ?></option>
                                                                    <?php } ?>
                                                                </select>

                                                                <a href="../Categorias/categorias.php" class="btn btn-primary"><i class="fa fa-plus"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">Nombre del producto:</label>
                                                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $producto['Nombre']; ?>" required maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="descripcion" class="form-label">Descripción del producto:</label>
                                                            <center><textarea id="editor" name="descripcion" class="form-control"><?php echo $producto['Descripcion']; ?></textarea></center>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="existencias" class="form-label" >Stock:</label>
                                                            <input type="number" id="existencias" name="existencias" value="<?php echo $producto['Existencias']; ?>" class="form-control" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="invminimo" class="form-label" >Inventario minimo:</label>
                                                            <input type="number" id="invminimo" name="invminimo" value="<?php echo $producto['InvMinimo']; ?>" class="form-control" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="invmaximo" class="form-label" >Inventario maximo:</label>
                                                            <input type="number" id="invmaximo" name="invmaximo" value="<?php echo $producto['InvMaximo']; ?>" class="form-control" required >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="costo" class="form-label">Precio compra:</label>
                                                            <input type="number" id="costo" name="costo" class="form-control" value="<?php echo $producto['Costo']; ?>" required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="precio" class="form-label">Precio venta:</label>
                                                            <input type="number" id="precio" name="precio" class="form-control"value="<?php echo $producto['PrecioVenta']; ?>"  required >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="descuento" class="form-label">Descuento:</label>
                                                            <input type="number" id="descuento" name="descuento" class="form-control" value="<?php echo $producto['descuento']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="otras_imagenes" class="form-label"  >Otras imagenes:</label>
                                                        <input type="file" name="otras_imagenes[]"  id="otras_imagenes" class="form-control" accept="image/jpeg"  multiple >
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-12 col-md-6">
                                                            <div class="row">
                                                                <?php foreach($imagenes as $imagen) { ?>
                                                                    <div class="col-4">
                                                                    <img src="<?php echo $imagen; ?>" class="img-thumbnail my-3" alt=""> <br>
                                                                    <button class="btn btn-danger btn-sm" onclick="eliminaImagen('<?php echo $imagen; ?>')">Eliminar</button>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="imagen_principal" class="form-label"  >Imagen principal del producto:</label>
                                                <input type="file" name="imagen_principal" id="imagen_principal" class="form-control" accept="image/jpeg" >
                                                <?php if(file_exists($imagenPrincipal)) { ?>
                                                    <img src="<?php echo $imagenPrincipal; ?>" class="img-thumbnail my-3" alt=""> <br>
                                                    <button class="btn btn-danger btn-sm" onclick="eliminaImagen('<?php echo $imagenPrincipal; ?>')">Eliminar</button>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    
                                        </div>





                                        <hr>
                                        <div class="form-group">
                                            <a href="productos.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit"  value="Guardar Producto" class="btn btn-primary">Guardar cambios</button>
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


<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );

    function eliminaImagen(urlImagen){
        let url = 'eliminar_imagen.php'
        let formData = new FormData()
        formData.append('urlImagen', urlImagen)

        fetch(url,{
            method:'POST',
            body: formData
        }).then((response)=>{
            if(response.ok){
                location.reload()
            }
        })
    }
</script>


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

