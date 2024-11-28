<!doctype html>
<html lang="en">

<head>
  <title>Cruds</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="<?php echo ADMIN_URL; ?>Menu/menu.css">
 <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

 <nav class="sidebar">
        <header>
            <div class="text logo">
                <span class="name">El Chinito</span>
                <span class="profe">Centro de datos</span>
            </div>
            <i class="bx bx-menu toggle"></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
            <div class="profile"> <!-- Agregamos la clase "profile" -->
          <img src="<?php echo ADMIN_URL; ?>Menu/CantanteVernacular.jpg" alt="profile_picture"> <!-- Corregimos las comillas y agregamos la etiqueta img -->
          <h4>Estefano Macotela</h4>
        </div>
        <ul class="menu-links">
                    <!-- LINK 1 -->
                    <li class="">
                        <a href="<?php echo ADMIN_URL; ?>Dashboard.php" data-href="Menu.html">
                            <i class="bx bx-home-alt icon"></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>
                    <!-- LINK 2 -->
                    <li class="" name="empleadolink">
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDempleados/Empleados.php">
                            <i class="bx bx-face icon"></i>
                            <span class="text nav-text">Empleados</span>
                        </a>
                    </li>

                    <li class="" name="clientelink">
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDclientes/clientes.php">
                            <i class="bx bx-face icon"></i>
                            <span class="text nav-text">Clientes</span>
                        </a>
                    </li>

                    <li class="">
                        <a href="<?php echo ADMIN_URL; ?>Menu/Categorias/categorias.php">
                            <i class='bx bx-label icon'></i>
                            <span class="text nav-text">Categorias</span>
                        </a>
                    </li>    

                    <!-- LINK 4 -->
                    <li class="">
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDproductos/productos.php">
                            <i class="bx bx-cube icon"></i>
                            <span class="text nav-text">Productos</span>
                        </a>
                    </li>
                    
                    <!-- LINK 6 -->

                    <li class="">
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDventas/ventas.php">
                            <i class='bx bx-label icon'></i>
                            <span class="text nav-text">Ventas</span>
                        </a>
                    </li>    

                    <li class="">
                        <a href="<?php echo ADMIN_URL; ?>Menu/Configuracion/configuracion.php">
                            <i class='bx bx-cog icon'></i>
                            <span class="text nav-text">Configuracion</span>
                        </a>
                    </li>


                    <div class="bottom-content">
                        <li class="">
                            <a href="<?php echo USER_URL; ?>">
                                <i class="bx bx-log-out icon"></i>
                                <span class="text nav-text">Salir</span>
                            </a>
                        </li>
                    </div>
                    
                </ul>
                
            </div>
        </div>
    </nav>