<?php

require '../Database.php';
require '../config/config.php';
require '../registro/clientefunciones.php';


$db = new Database();
$con = $db->conectar();

$sql = $con->prepare("SELECT idProducto, Nombre, Descripcion, PrecioVenta FROM producto WHERE activo=1");
$sql-> execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

//print_r($_SESSION);

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

<!--EMCABEZADO DE LA PAGINA WEB ZZZ-->

<?php include '../menu.php';?>

    <!--SECCION DE FOTOS-->
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./ventas_img/publicidad_2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./ventas_img/publicidad_2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="./ventas_img/publicidad_2.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>

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
<section class="container" id="ProductosP">


    <div class=" d-flex justify-content-between align-items-center">

        <h2 style="font-size: 99%;" class="h4 m-4 text-dark">
            <img src="./ventas_img/rectangulo_rojo.png" alt="">
            Para ti
        </h2>

        <button class="mostrar-mas btn btn-danger" onclick="mostrarMas()">Mostrar más</button>

    </div>
    <br>

    <div class="row row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-5">
        
        <!--PRODUCTO 1-->
        <?php foreach($resultado as $row) { ?>
        <button class="button" style=" background-color: white; border: none;" onclick="addProducto(<?php echo $id;?>, <?php echo $token_tmp?>)">
                <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white"
                        <?php
                        $id = $row['idProducto'];
                        $imagen = "../img/productos/" . $id . "/principal.svg";
                        
                        if(!file_exists($imagen)) {
                            $imagen = "../img/no-photo.jpg" ;
                        }

                        ?>  
                        style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                        <img id="img_productos" src="<?php echo $imagen; ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title pt-2 text-center text-dark"><?php echo $row['Nombre']; ?></h5>
                                    <p class="card-text text-dark-50 description"><?php echo $row['Descripcion']; ?></p>
                                    <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;">
                                    <span class="precio text-danger"><?php echo $row['PrecioVenta']; ?></span></h5>
                                </div>
                        </div>
                    
                    </div>
            </button>
        <?php } ?>   

        
        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_3.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Arroz Costeño 750G</h5>
                        <p class="card-text text-dark-50 description">"Arroz Costeño 750G: Grano de arroz de calidad premium"</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->
        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_4.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">AYUDÍN Líquido </h5>
                        <p class="card-text text-dark-50 description">"AYUDÍN Líquido: Versátil producto de limpieza para una higiene efectiva"</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_55.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Harina Blanca Flor</h5>
                        <p class="card-text text-dark-50 description">"Harina Blanca Flor: Harina de trigo de alta calidad ideal para repostería"
                        </p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button>
    </div>
     -->

    <!--INICIO CONTENIDO OCULTO-->
    <!-- <div id="contenidoOculto" style="display: none;"
        class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5"> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_66.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Aceite Vegetal Cil</h5>
                        <p class="card-text text-dark-50 description">
                            "Aceite Vegetal Cil: Aceite de cocina versátil y saludable para diversas preparaciones culinarias."</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_777.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Filete de Atún Florida</h5>
                        <p class="card-text text-dark-50 description">
                            "Filete de Atún Florida: Exquisito filete de atún de calidad superior"</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_87.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Colins Manzanilla</h5>
                        <p class="card-text text-dark-50 description">"Mc Colins Manzanilla: Deliciosa manzanilla para disfrutar momentos de relajación y bienestar."</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_1.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Estoy cansado jefe</h5>
                        <p class="card-text text-dark-50 description">Some quick example text to build on the card
                            title
                            and make up the bulk of the card's content.</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button> -->

        <!--PRODUCTO 1-->
        <!-- <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_1.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Estoy cansado jefe</h5>
                        <p class="card-text text-dark-50 description">Some quick example text to build on the card
                            title
                            and make up the bulk of the card's content.</p>
                        <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span
                                class="precio text-danger"> $ 12.00</span></h5>
                    </div>
                </div>
            </div>
        </button>
    </div> -->
    <!--Fin contennido oculto-->

</section>

<!--OFERTAS-->
<section class="container2 ofertas_v" id="Ofertas_x">

    <h4 class="h4 m-4 text-dark" style="font-size: 99%;"><img src="./ventas_img/rectangulo_rojo.png" alt=""> Super
        ofertas</h4>
    <br>

    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-5">

        <!--OFERTA 1-->
        <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_2.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Avena 3 Ositos</h5>
                        <p class="card-text text-dark-50 description">"Avena 3 Ositos: Deliciosa avena instantánea con ternura y nutrición para toda la familia."
                        </p>
                        <h5 class="text-danger text-center text-danger" style="margin-top: -10px; font-size: 90%; ">
                            S/10.10<span class="precio text-success"> $ 9.00</span></h5>
                    </div>
                </div>
            </div>
        </button>

        <!--OFERTA 1-->
        <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_3.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark"> Arroz Costeño 750G</h5>
                        <p class="card-text text-dark-50 description">"Arroz Costeño 750G: Grano de arroz de calidad premium en presentación de 750 gramos."</p>
                        <h5 class="text-danger text-center text-danger" style="margin-top: -10px; font-size: 90%; ">
                            S/10.10<span class="precio text-success"> $ 9.00</span></h5>
                    </div>
                </div>
            </div>
        </button>

        <!--OFERTA 1-->
        <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_4.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">AYUDÍN Líquido</h5>
                        <p class="card-text text-dark-50 description">"AYUDÍN Líquido: Versátil producto de limpieza para una higiene efectiva en el hogar."</p>
                        <h5 class="text-danger text-center text-danger" style="margin-top: -10px; font-size: 90%; ">
                            S/10.10<span class="precio text-success"> $ 9.00</span></h5>
                    </div>
                </div>
            </div>
        </button>

        <!--OFERTA 1-->
        <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_66.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark">Aceite Vegetal Cil</h5>
                        <p class="card-text text-dark-50 description">
                            "Aceite Vegetal Cil: Aceite de cocina versátil y saludable para diversas preparaciones culinarias."</p>
                        <h5 class="text-danger text-center text-danger" style="margin-top: -10px; font-size: 90%; ">
                            S/10.10<span class="precio text-success"> $ 9.00</span></h5>
                    </div>
                </div>
            </div>
        </button>

        <!--OFERTA 1-->
        <button class="button" style=" background-color: white; border: none;">
            <div class="col d-flex justify-content-center mb-4">
                <div class="card shadow mb-1 bg-white"
                    style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                    <img id="img_productos" src="./ventas_img/producto_87.svg" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title pt-2 text-center text-dark"> Colins Manzanilla</h5>
                        <p class="card-text text-dark-50 description">"Mc Colin’s Manzanilla: Deliciosa manzanilla para disfrutar momentos de relajación y bienestar."</p>
                        <h5 class="text-danger text-center text-danger" style="margin-top: -10px; font-size: 90%; ">
                            S/10.10<span class="precio text-success"> $ 9.00</span></h5>
                    </div>
                </div>
            </div>
        </button>



    </div>

</section>


<!-- MODAL DE CARRITO  -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Carrito de compras</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <br>
                <table class="table table-white table-hover">
                    <thead>
                        <tr class="text-danger">
                            <th scope="col">#</th>
                            <th scope="col">Productos</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                        </tr>
                    </thead>
                    <tbody class="tbody">

                    </tbody>
                </table>
                <br><br>
                <div class="row mx-4">
                    <div class="col">
                        <h3 class="itemCartTotal text-dark" style=" font-size: 20px; margin-top: 9px;">Total: 0</h3>
                    </div>
                    <div class="col d-flex justify-content-end">
                        <button class="btn btn-success">COMPRAR</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--CREAMOS EL FOOTER/SECCION CONTACTO-->
<section class="contacto" id="informacion_v">

    <div class="footer container" id="contactos">

        <div class="final">

            <div class="links">
                <h4>Enlaces de la pagina</h4>
                <ul>
                    <li><a href="">Inicio</a></li>
                    <li><a href="">Nosotros</a></li>
                    <li><a href="">Ofertas</a></li>
                    <li style="list-style: none;"><a href="">Otros</a></li>
                </ul>
            </div>


            <div class="links">
                <h4>Responsables del la web</h4>
                <ul>
                    <li><a href="">Alessandro</a></li>
                    <li><a href="">Stefano</a></li>
                    <li><a href="">Giovanni</a></li>
                    <li><a href="">Sebastian</a></li>
                    <li style="list-style: none;"><a href="">Mamani</a></li>
                </ul>
            </div>

            <div class="links">
                <h4>Información adicional</h4>
                <ul>
                    <li style="list-style: none;"><a href="http://rojasmarket.atspace.com/" ;">Pagina oficial</a></li>
                </ul>
            </div>

            <div class="links ">
                <h4>Siguenos</h4>
                <div class="redes">
                    <a href="https://www.facebook.com/rojasmarket"><img class="footer_img"
                            src="./ventas_img/Facebookk.svg"></a>
                    <a href=""><img class="footer_img" src="./ventas_img/Instagramm.svg"></a>
                    <a href=""><img class="footer_img" src="./ventas_img/xx.svg"></a>
                    <a href=""><img class="footer_img" src="./ventas_img/Youtubee.svg"></a>
                </div>
            </div>


        </div>
    </div>
    <footer class="bg-danger p-3 mt-5">
        <p class="text-center m-0 text-light">ESTOY CANSADO JEFE</p>
    </footer>
</section>



<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

</body>

</html>