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




<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Detalle producto</h1>
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
                            <h3 class="card-title"></h3>
                            <div class="card-tools">
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="col">
                                <div class="col-md-12">

                                    <form enctype="multipart/form-data" method="post" autocomplete="off">

                                    <input type="hidden" name="idProducto" value="<?php echo $producto['idProducto']; ?>">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="categoria" class="form-label">Categoría:</label>


                                                            <?php
                                                            // Suponiendo que ya tienes el ID de la categoría en $producto['idCategoria']
                                                            $categoriaNombre = ""; // Variable para almacenar el nombre de la categoría

                                                            // Busca el nombre de la categoría según el ID
                                                            foreach ($categorias_datos as $categoria_dato) {
                                                                if ($categoria_dato['id_categoria'] == $producto['idCategoria']) {
                                                                    $categoriaNombre = $categoria_dato['nombre_categoria'];
                                                                    break; // Sale del bucle una vez que encuentra la categoría
                                                                }
                                                            }
                                                            ?>
                                                            
                                                            <div style="display: flex">
                                                                <input type="text" id="categoria_nombre" name="categoria_nombre" class="form-control" 
                                                                    value="<?php echo htmlspecialchars($categoriaNombre); ?>" readonly />

                                                                <input type="hidden" id="categoria" name="categoria" value="<?php echo htmlspecialchars($producto['idCategoria']); ?>" />
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">Nombre del producto:</label>
                                                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $producto['Nombre']; ?>" required maxlength="50" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <label for="descripcion" class="form-label">Descripción del producto:</label>
                                                            <center><textarea id="editor" name="descripcion" class="form-control" readonly><?php echo $producto['Descripcion']; ?></textarea></center>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="existencias" class="form-label" >Stock:</label>
                                                            <input type="number" id="existencias" name="existencias" value="<?php echo $producto['Existencias']; ?>" class="form-control" disabled >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="invminimo" class="form-label" >Inventario minimo:</label>
                                                            <input type="number" id="invminimo" name="invminimo" value="<?php echo $producto['InvMinimo']; ?>" class="form-control" disabled >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="invmaximo" class="form-label" >Inventario maximo:</label>
                                                            <input type="number" id="invmaximo" name="invmaximo" value="<?php echo $producto['InvMaximo']; ?>" class="form-control" disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="costo" class="form-label">Precio compra:</label>
                                                            <input type="number" id="costo" name="costo" class="form-control" value="<?php echo $producto['Costo']; ?>" disabled >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="precio" class="form-label">Precio venta:</label>
                                                            <input type="number" id="precio" name="precio" class="form-control"value="<?php echo $producto['PrecioVenta']; ?>"  disabled >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label for="descuento" class="form-label">Descuento:</label>
                                                            <input type="number" id="descuento" name="descuento" class="form-control" value="<?php echo $producto['descuento']; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label for="otras_imagenes" class="form-label"  >Otras imagenes:</label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="imagen_principal" class="form-label"  >Imagen principal del producto:</label>
                                                <?php if(file_exists($imagenPrincipal)) { ?>
                                                    <img src="<?php echo $imagenPrincipal; ?>" class="img-thumbnail my-3" alt=""> <br>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    
                                        </div>





                                        <hr>
                                        <div class="form-group">
                                            <a href="productos.php" class="btn btn-primary">Regresar</a>
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




