<?php

require_once '../config/config.php';



$db = new Database();
$con = $db->conectar();

$id = isset($_GET['id']) ? $_GET['id'] : '';
$token = isset($_GET['token']) ? $_GET['token'] : '';

if ($id == '' || $token == ''){
    echo 'Error al procesar la peticion';
    exit; 
} else{

    $token_tmp = hash_hmac('sha512', $id, KEY_TOKEN);

    if($token == $token_tmp){
        $sql = $con->prepare("SELECT count(idProducto) FROM producto WHERE idProducto=? AND activo=1");
        $sql-> execute([$id]);
        if($sql ->fetchColumn()>0){
            $sql = $con->prepare("SELECT Nombre,Descripcion,PrecioVenta,descuento FROM producto WHERE idProducto=? AND activo=1 LIMIT 1");
            $sql-> execute([$id]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre = $row['Nombre'];
            $descripcion = $row['Descripcion'];
            $precio = $row['PrecioVenta'];
            $descuento = $row['descuento'];
            $precio_desc = $precio - (($precio*$descuento) / 100);  
            $dir_images = '../img/productos/'.$id.'/';

            $rutaImg = $dir_images . 'principal.jpg';

            if(!file_exists($rutaImg)){
                $rutaImg = '../img/no-photo.jpg';

            }

            $imagenes = array();

            if(file_exists($dir_images)){

            
            $dir = dir($dir_images);

            while(($archivo = $dir->read()) != false){
                if($archivo != 'principal.jpg' && (strpos($archivo,'jpg')||strpos($archivo,'jpeg'))){
                    $imagenes[] = $dir_images . $archivo;
                    
                }
            }
        
            $dir->close();
            }
        } else{
            echo 'Error al procesar la peticion';
            exit;  
        }
    }else{
        echo 'Error al procesar la peticion';
        exit;       
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#bla" />

    <title>Ventas</title>
    <!-- CSS only -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <link rel="stylesheet" href="Style_v.css" />
</head>

<body>

<script>
    function addProducto (id,cantidad,token){
    let url = '../clases/carrito.php'
    let formData = new FormData()
    formData.append('id',id)
    formData.append('cantidad',cantidad)
    formData.append('token',token)

    fetch(url,{
        method:'POST', 
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data => {  
        if(data.ok){
            let elemento = document.getElementById("num_cart")  
            elemento.innerHTML = data.numero
        }else{
            alert("No hay suficientes existencias");
        }
    })
}
</script>

<!--EMCABEZADO DE LA PAGINA WEB ZZZ-->

<?php include '../menu.php';?>

<!--ALERTAS-->
<!-- <section class="alerta">
    <br>
    <div class="alert position-sticky top-0 alert-primary hide" role="alert">
        !Producto Añadido al carrito!
    </div>

    <div class="alert position-sticky top-0 alert-danger remove" role="alert">
        !Producto eliminado del carrito!
    </div>
</section> -->

<!--PRODUCTOS-->
<main>
    <div class="container">
        <div class="row">
                <div class="col-md-6 order-md-1">

                    <div id="carouselImages" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="<?php echo $rutaImg; ?>" class="d-block w-100">
                            </div>

                            <?php foreach($imagenes as $img) {?>
                            <div class="carousel-item ">
                                <img src="<?php echo $img; ?>" class="d-block w-100">

                            </div>
                            <?php }?>

                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselImages" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselImages" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-6 order-md-2">
                    <h2><?php echo $nombre; ?></h2>
                    
                    <?php if($descuento>0) { ?>
                        <p><del><?php echo MONEDA .  number_format($precio,2,'.',','); ?></del></p>
                        <h2>
                            <?php echo MONEDA .  number_format($precio_desc,2,'.',','); ?>
                            <small class="text-success"><?php echo $descuento; ?>% descuento</small>
                        </h2>   

                        <?php } else { ?>

                            <h2><?php echo MONEDA .  number_format($precio,2,'.',','); ?></h2>

                    <?php }?>

                    <p class="lead">
                        <?php echo $descripcion; ?>
                    </p>

                    <div class="col-3 my-3">
                        Cantidad:<input class="form-control" id="cantidad" name="cantidad" type="number" min="1" max="20" value="1">
                    </div>

                    <div class="d-grid gap-3 col-10 mx-auto">
                    <button class="btn btn-primary" type="button" style="background-color: #FFA07A; border-color: #FFA07A; color: white;">Comprar ahora</button>

                        <button class="btn btn-outline-primary" type="button" onclick="addProducto(<?php echo $id; ?>, cantidad.value,'<?php echo $token_tmp; ?>')">Agregar al carrito</button>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalCarrito">Abrir carrito (<?php echo $num_cart; ?>)</button>

                    </div>
                    
                </div>
        </div>
    </div>                    



   <!-- Modal -->
   <div class="modal fade" id="modalCarrito" tabindex="-1" aria-labelledby="modalCarritoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCarritoLabel">Carrito de compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <?php require 'checkout.php'; ?>
                </div>
            </div>
        </div>
    </div>

</main>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
 integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>




</body>

</html>