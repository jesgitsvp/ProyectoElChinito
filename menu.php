<header>
    <!-- EMCABEZADO DE LA PAGINA WEB ZZZ-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
        <div class="container-fluid mx-auto">

            <img id="img_ventas" src="ventas_img/LogoChinito.png" alt="" class="mx-auto">

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse menu_responsi" id="navbarNavAltMarkup">

                <div class="navbar-nav ms-auto menu_list">

                    

                    <a id="sube" class="nav-link active" aria-current="page" href="../index.php">Inicio</a>

                    <a id="sube" class="nav-link" href="Catalogo.php">Catalogo<img id="menu_var"
                            src="./ventas_img/menu_var.png"></a>
                
                    <a id="sube" class="nav-link" href="#Ofertas_x">Ofertas<img id="menu_va"
                            src="./ventas_img/menu_var.png"></a>
                    <a id="sube" class="nav-link" href="#informacion_v">Informacion<img id="menu_var"
                            src="./ventas_img/menu_var.png"></a>



                    <div class="collapse navbar-collapse menu_responsi_boton" id="navbarNavAltMarkup">
                        
                     <?php if(isset($_SESSION['user_id'])) { ?>
                        <div class="dropdown">
                            <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php echo $_SESSION['user_name']; ?>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="btn_session">
                                <li><a class="dropdown-item" href="../logout.php">Cerrar sesión</a></li>
                            </ul>
                        </div>  
                        <?php } else { ?>
                     <?php } ?>
                    </div>



                </div>
            </div>
        </div>
    </nav>

</header>