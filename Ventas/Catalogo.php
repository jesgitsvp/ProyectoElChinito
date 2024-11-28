<?php

require_once '../Database.php';
require_once '../config/config.php';
require_once '../registro/clientefunciones.php';



$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT idProducto, Nombre, Descripcion, PrecioVenta FROM producto WHERE activo=1");
$sql-> execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

//session_destroy();
//print_r($_SESSION);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#bla" />
    <title>Catalogo</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style_v.css" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/LogoChinito.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

</head>

<script>
    function addProducto(id,token){
        let url = '../clases/carrito.php'
        let formData = new FormData()
        formData.append('id',id)
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
            }   else {
                alert("No hay suficientes existencias.")
            }
        })
    }
</script>

<body>

<?php include '../menu2.php'; ?>

<!--ALERTAS-->
<section class="alerta">
    <br>
    <div class="alert position-sticky top-0 alert-primary hide" role="alert">
        !Producto Añadido al carrito!
    </div>

    <div class="alert position-sticky top-0 alert-danger remove" role="alert">
        !Producto eliminado del carrito!
    </div>
</section>


<!--PRODUCTOS-->

<div class="productos1">
    <section class="container" >
        
    <div class="row row-cols-sm-2 row-cols-lg-3 row-cols-xl-5">
        
        <!--PRODUCTO 1-->
        <?php foreach($resultado as $row) { ?>
        <div class="button" style=" background-color: white; border: none; height:28.5rem;" onclick="addProducto(<?php echo $id;?>, <?php echo $token_tmp?>)">
                <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white" 
                        <?php
                        $id = $row['idProducto'];
                        $imagen_jpg = "../img/productos/" . $id . "/principal.jpg";
                        $imagen_jpeg = "../img/productos/" . $id . "/principal.jpeg";
                        $imagen = file_exists($imagen_jpg) ? $imagen_jpg : $imagen_jpeg;

                                                
                        if(!file_exists($imagen)) {
                            $imagen = "../img/no-photo.jpg" ;
                        }

                        ?>  
                        style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none; height: 400px;">
                        <a id = "img_productos" class="d-block w-80" href="details.php?id=<?php echo $row['idProducto'];?>&token=<?php echo hash_hmac('sha512',$row['idProducto'], KEY_TOKEN); ?> ">
                        <img  src="<?php echo $imagen; ?>" class="card-img-top " alt="...">
                        </a>
                                <div class="card-body" >
                                    <h5 class="card-title pt-2 text-center text-dark" style="font-size: 18px;"><?php echo $row['Nombre']; ?></h5>
                                    <br>
                                    <h5 class="text-danger " style="margin-top: -10px; font-size: 95%;">
                                    <span class="precio" style="color : #FFA07A"><span>Precio S/</span> <?php echo $row['PrecioVenta']; ?></span></h5>
                                    
                                    <div class="btn-group d-flex justify-content-center">
                                        <button class="btn btn-outline-danger" type="button" onclick="addProducto(<?php echo $row['idProducto']; ?>, '<?php echo hash_hmac('sha512',$row['idProducto'], KEY_TOKEN); ?>')
                                        ">Añadir al carrito</button>
                                    </div>
                                </div>
                        </div>
                    
                 </div>
        </div>
        <?php } ?>   
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

<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<script src="https://kit.fontawesome.com/c03774d4fa.js" crossorigin="anonymous"></script>

</body>

</html>