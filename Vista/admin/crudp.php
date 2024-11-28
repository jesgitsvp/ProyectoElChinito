<?php
    require 'config/Database.php';
    

    $db=new Database();
    $con = $db -> conectar();

?>


<!doctype html>
<html lang="en">

<head>
  <title>Cruds</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" href="Menu/menu.css">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

  <!-- Bootstrap CSS v5.2.1 -->


</head>
 <body>
 <nav class="sidebar close">
        <header>
            <div class="text logo">
                <span class="name">Minimarket Rojas</span>
                <span class="profe">Centro de datos</span>
            </div>
            <i class="bx bx-menu toggle"></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
            <div class="profile"> <!-- Agregamos la clase "profile" -->
          <img src="Menu/CantanteVernacular.jpg" alt="profile_picture"> <!-- Corregimos las comillas y agregamos la etiqueta img -->
          <h4>Estefano Mcotela</h4>
          <p>Developer</p>
        </div>
                <ul class="menu-links">

                    <!-- LINK 1 -->
                    <li class="nav-link">
                        <a href="#" data-href="Menu.html">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">dashboard</span>
                        </a>
                    </li>
                    <!-- LINK 2 -->
                    <li class="nav-link">
                        <a href="/Menu/CRUDEmpleados/index.php">
                            <i class="bx bx-face icon"></i>
                            <span class="text nav-text">Empleados</span>
                        </a>
                    </li>
                    <!-- LINK 3 -->
                    <li class="nav-link">
                        <a href="/Menu/CRUDProovedores/proovedores.php">
                            <i class="bx bx-archive-in icon"></i>
                            <span class="text nav-text">Proveedores</span>
                        </a>
                    </li>
                    <!-- LINK 4 -->
                    <li class="nav-link">
                        <a href="/Menu/CRUDproductos/productos.php">
                            <i class="bx bx-cube icon"></i>
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>
                    <!-- LINK 5 -->
                    <li class="nav-link">
                        <a href="#">
                            <i class="bx bx-select-multiple icon"></i>
                            <span class="text nav-text">Ventas</span>
                        </a>
                    </li>
                    <!-- LINK 6 -->
                    <li class="nav-link">
                        <a href="#contenido">
                            <i class="bx bxs-wink-tongue icon"></i>
                            <span class="text nav-text">Pagos</span>
                        </a>
                    </li>
                </ul>


                <div class="bottom-content">
                    <li class="">
                        <a href="">
                            <i class="bx bx-log-out icon"></i>
                            <span class="text nav-text">salir</span>
                        </a>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    

    <script src="Menu/menu.js"></script>

    <script>
    const toggleButton = document.querySelector('.toggle');
    // Obtén una referencia al elemento con clase "profile"

    // Agrega un controlador de eventos al botón de alternancia
    toggleButton.addEventListener('click', function () {
        if (profileElement) {
            profileElement.style.visibility = profileElement.style.visibility === 'hidden' ? 'visible' : 'hidden';
        }
    });

    // Obtén una referencia al elemento con clase "profile"
    const profileHeading = document.querySelector('.profile h4');
    const profileDescription = document.querySelector('.profile p');

    // Agrega un controlador de eventos al botón de alternancia
    toggleButton.addEventListener('click', function () {
        if (profileHeading && profileDescription) {
            if (profileHeading.style.visibility === 'hidden' || profileHeading.style.visibility === '') {
                profileHeading.style.visibility = 'visible';
                profileDescription.style.visibility = 'visible';
            } else {
                profileHeading.style.visibility = 'hidden';
                profileDescription.style.visibility = 'hidden';
            }
        }
    });
    </script>
    
 </body>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
  integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
  integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
</body>

</html>