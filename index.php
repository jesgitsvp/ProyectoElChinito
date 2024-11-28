<?php 

require_once 'Database.php';
require_once 'config/config.php';
require_once 'registro/clientefunciones.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polleria "EL CHINITO"</title>
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/LogoChinito.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    
</head>

<body>

    <header>
        <!-- EMCABEZADO DE LA PAGINA WEB ZZZ-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">          
              <div class="container-fluid mx-auto">
                <img id="img_ventas" src="img/LogoChinito.png" alt="" class="mx-auto">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse menu_responsi" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto menu_list">
                        <a id="sube" class="nav-link active" aria-current="page" href="#">Inicio</a>
                        <a id="sube" class="nav-link" href="#Nosotros">Nosotros</a>
                        <a id="sube" class="nav-link" href="#Ofertas">Ofertas</a>
                        <a id="sube" class="nav-link" href="./Ventas/Catalogo.php">Catalogo</a>
                        <a id="sube" class="nav-link" href="#contactos">Informacion</a>

                        <div class="collapse navbar-collapse menu_responsi_boton" id="navbarNavAltMarkup">
    <button id="a" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">Contactanos</button>
    <?php if(isset($_SESSION['user_id'])){ ?>
        <a href="#" class="btn btn-danger"><?php echo $_SESSION['user_name']; ?></a>
    <?php } else { ?>
        <a href="login/login.php"><button id="a" type="button" class="btn btn-outline-danger">Iniciar Sesion</button></a>
    <?php } ?>    
</div>

                    </div>
                </div>
            </div>
        </nav>

        <!--VENTANA EMERGENTE PARA CONTACTAR-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Contactanos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!--AÑADIMOS UN CRAD DE BOOSTRAP-->
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Whatsapp</h5>
                                        <p class="card-text">"¡Estamos aquí para ayudarte! Contacta con nosotros
                                            rápidamente a través de WhatsApp para cualquier consulta o solicitud de
                                            información."</p>
                                        <a href="https://chat.whatsapp.com/DL7fwsVp0wu7tJy22Zqfow" class="btn btn-success">Escribenos</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Llamada telefonica</h5>
                                        <p class="card-text">"Si prefieres una atención personalizada, no dudes en
                                            llamarnos. Estamos listos para atenderte y brindarte la mejor asistencia."
                                        </p>
                                        <a href="#" class="btn btn-primary">Llamar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- CREAMOS OTRA SECCION PARA LA PRESENTACION DEL MINIMARKET-->
        <section class="Present_container container stefano_main">
            <article class="Present_texto">
                <!-- Ponemos el titulo de la presentacion de la empresa-->
                <h1 class="Present_titulo">POLLERIA "EL CHINITO"</h1>
                <!-- Ponemos la descipcion de la empresa-->
                <p class="Present_descripcion">En El Chinito, creemos que cada cliente es especial. Nuestra pasión es superar tus expectativas desde el primer bocado. Desde nuestros inicios, nos dedicamos a complacer los paladares más exigentes de Ica.</p>
                <!--Acompañamos con un video de presentacion-->
                <a href="index.php" class="Present_mp4">Ver Carta</a>
            </article>
            <!--Agregamos la imagen de la presentacion-->
            <figure class="Present_figure">
                <img src="img/chef.png" class="Present_img mx-auto">
            </figure>
        </section>
    </header>

    <!--CREAMOS MAS SECCIONES PARA LA PAG DEL MINI...-->
    <main class="main">

        <!-- SECCION PARA LOS ELEMENTO QUE CONTIENE NOSOTROS-->
        <section class="sec_nosotros" id="Nosotros">
            <article class="nosotros_container container stefano_main">

                <figure class="nosotros_figure">
                    <img src="./img/chef 1.png" class="nosotros_img">
                </figure>

                <div class="nosotros_div">
                    <h2 class="subtitulo">Quiénes
                        somos</h2>
                    <p class="nosotros_texto">En El Chinito, nos enorgullece ofrecer deliciosos pollos a la brasa y platillos tradicionales de la más alta calidad. Desde nuestra apertura, nos hemos dedicado a satisfacer los paladares de nuestros clientes con sabores auténticos y un servicio cercano y amigable.
                    </p>
                </div>
            </article>
        </section>

        <!-- SECCION PARA LOS ELEMENTO QUE CONTIENE OFERTAS-->
        <section class="sec_ofertas container" id="Ofertas">

            <h2 class="subtitulo"> ¡QUE OFERTAS TENEMOS PARA TI! </h2>

            <div class="row row-cols-sm-2 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 justify-content-between">

                <!--PRODUCTO 1-->
                
                <button class="button" style=" background-color: white; border: none;">
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white h-100" style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                            <img id="img_productos" src="./img/PolloEntero.jpg" class="card-img-top rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title pt-2 text-center text-dark">Pollo a la Brasa Completo</h5>
                                <p class="card-text text-dark-50 description">"Pollo marinado y asado a la parrilla, acompañado de papas fritas, ensalada fresca y salsa criolla."</p>
                                <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span class="precio text-danger"> S/ 65.00</span></h5>
                            </div>
                        </div>
                    </div>      
                </button>
            
                <!--PRODUCTO 2-->
                
                <button class="button" style=" background-color: white; border: none;">
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white h-100" style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                        <img id="img_productos" src="./img/Broaster.jpg" class="card-img-top rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title pt-2 text-center text-dark">Pollo Broaster</h5>
                                <p class="card-text text-dark-50 description">"Pollo empanizado y frito estilo broaster, servido con papas fritas y ensalada."</p>
                                <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span class="precio text-danger"> S/ 12.00</span></h5>
                            </div>
                        </div>
                    </div>
                </button>
                <!--PRODUCTO 3-->
                <button class="button" style=" background-color: white; border: none;">
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white h-100" style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                        <img id="img_productos" src="./img/chicharronDP.jpg" class="card-img-top rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title pt-2 text-center text-dark">Chicharrón de Pollo</h5>
                                <p class="card-text text-dark-50 description">
                                    "Trozos de pollo frito acompañados de papas fritas, yuca sancochada, salsa criolla y ají."</p>
                                <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span class="precio text-danger"> S/ 12.00</span></h5>
                            </div>
                        </div>
                    </div>
                </button>
                <!--PRODUCTO 1-->
                <button class="button" style=" background-color: white; border: none;">
                    <div class="col d-flex justify-content-center mb-4">
                        <div class="card shadow mb-1 bg-white" style="border-radius: 38px; width: 20rem; border: 1px solid #bcbbbb; border: none">
                        <img id="img_productos" src="./img/alitas.jpg" class="card-img-top rounded-circle" style="width: 200px; height: 200px; object-fit: cover;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title pt-2 text-center text-dark">Alitas de Pollo</h5>
                                <p class="card-text text-dark-50 description">"Alitas de pollo a la brasa marinadas y glaseadas con una variedad de salsas: BBQ, picante, teriyaki, entre otras"</p>
                                <h5 class="text-danger text-center" style="margin-top: -10px; font-size: 95%;"><span class="precio text-danger"> S/ 12.00</span></h5>
                            </div>
                        </div>
                    </div>
                </button>

            </div>
        </section>

        <!--CREAMOS UNA SECCION PARA OTROS-->
        <section class="otros " id="Informacion">

            <div class="otros_main container">
                <article class="otros_texto">
                    <h1 class="subtitulo">Misión</h1>
                    <p class="texto">En "El Chinito", nos comprometemos a deleitar a nuestros clientes con pollos a la brasa de la más alta calidad, preparados con sabores auténticos y servidos en un ambiente acogedor y familiar. Nos esforzamos por ser reconocidos como el lugar preferido en Ica para disfrutar de una experiencia gastronómica única, donde la calidad, el servicio excepcional y la satisfacción del cliente son nuestra prioridad absoluta.</p>
                    <!-- COLOCAMOS UNA DIRECCION REFERENCIA/VIDEO-->
                    <a href="https://www.youtube.com/watch?v=hlDw7ktS8_8" class="otros_boton">Conocer mas</a>
                </article>
                <!-- AGREGAMOS UNA IMAGGEN PARA LA SECCION OTROS-->
                <figure class="otros_figure">
                    <img src="./img/conocenos.svg" class="otros_img">
                </figure>
            </div>

        </section>
    </main>

    <!--CREAMOS EL FOOTER/SECCION CONTACTO-->
    <section class="contacto container">

        <div class="footer" id="contactos">

            <div class="final">

                <div class="links">
                    <h4>Enlaces de la pagina</h4>
                    <ul>
                        <li><a href="">Inicio</a></li>
                        <li><a href="">Nosotros</a></li>
                        <li><a href="">Ofertas</a></li>
                        <li><a href="">Otros</a></li>
                    </ul>
                </div>


                <div class="links">
                    <h4>Responsables del la web</h4>
                    <ul>
                        <li><a href="">Alessandro</a></li>
                        <li><a href="">Stefano</a></li>
                        <li><a href="">Giovanni</a></li>
                        <li><a href="">Sebastian</a></li>
                        <li><a href="">Mijael</a></li>
                    </ul>
                </div>

                <div class="links">
                    <h4>Información adicional</h4>
                    <ul>
                        <li><a href="http://rojasmarket.atspace.com/">Pagina oficial</a></li>
                    </ul>
                </div>

                <div class="links ">
                    <h4>Siguenos</h4>
                    <div class="redes">
                        <a href="https://m.facebook.com/people/Poller%C3%ADa-El-Chinito/100063644227235/"><img class="footer_img" src="./img/Facebookk.svg"></a>
                        <a href=""><img class="footer_img" src="./img/Instagramm.svg"></a>
                        <a href=""><img class="footer_img" src="./img/xx.svg"></a>
                        <a href=""><img class="footer_img" src="./img/Youtubee.svg"></a>
                    </div>
                </div>


            </div>
        </div>

    </section>

    <!-- Agrega la referencia a Bootstrap JS y Popper.js -->
    <script src="./fun.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>