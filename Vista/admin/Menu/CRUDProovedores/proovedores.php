<?php
require '../../../Database.php';
$db = new Database();
$con = $db->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $ruc = $_POST['ruc'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];


    // Corregir la consulta SQL
    $sql = $con->prepare("INSERT INTO proveedor (nombre, direccion, telefono, correo, ruc) VALUES (?, ?, ?, ?, ?)");

    $sql->execute([$nombre, $direccion, $telefono, $email, $ruc]);
}

// Consulta para obtener la lista de empleados
$sql = $con->prepare("SELECT idProveedores, Nombre, Direccion, Telefono, Correo, RUC FROM proveedor");
$sql->execute();
$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);  
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proovedores</title>
    <link rel="stylesheet" href="proveedores.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <img src="../../Menu/CantanteVernacular.jpg" alt="profile_picture">  <!-- Corregimos las comillas y agregamos la etiqueta img -->
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
                        <a href="../CRUDempleados/Empleados.php">
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
                        <a href="../CRUDproductos/productos.php">
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
    </nav>
    
    <div class="content mt-5">
        <header class="content-header">
            <h1>
                Buscar proovedores
                <input type="text" placeholder="Buscar proovedor...">
                <i class="fas fa-search"></i>
            </h1>
        </header>
        
        <button id="show-form-btn" class="show-form-button">Registrar Proovedor</button>
        <div class="supplier-container">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">RUC</th>
                        <th scope="col">telefono</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($resultado as $row) { ?>
                    <tr>
                        <td scope="row"><?php echo $row['idProveedores']; ?></td>
                        <td><?php echo $row['Nombre']; ?></td>
                        <td><?php echo $row['RUC']; ?></td>
                        <td><?php echo $row['Telefono']; ?></td>
                        <td><?php echo $row['Direccion']; ?></td>
                        <td><?php echo $row['Correo']; ?></td>

                        
                        <td>
                         <a  class="delete-icon" href="eliminar_proveedor.php?id=<?php echo $row['idProveedores']; ?>" class="delete-icon">Borrar</a>

                        <a href="#" class="delete-icon">Editar</a>
                        </td>
                    </tr>
                <?php } ?>   
                </tbody>
            </table>
        </div>
    </div>
    <div class="form-container">
    <!-- Tu formulario y campos van aquí -->

    <div class="supplier-container">
    <form id="supplier-form" class="supplier-form" method="post" action="proovedores.php">
        <div class="scrollable-content">
            
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre">
            </div>
            <div class="form-group">
                <label for="ruc">RUC</label>
                <input type="text" id="ruc" name="ruc">
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono">
            </div>
            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion">
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email">
            </div>
        </div>
        <button type="submit" class="save-button">Guardar</button>
        <button type="button" class="cancel-button" id="cancel-button">Cancelar</button>
    </form>
</div>

</div>

    <script src="../menu.js"></script>
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
    <script>
        
    // Obtén una referencia al botón y al formulario
    const showFormButton = document.getElementById('show-form-btn');
    const supplierForm = document.querySelector('.supplier-form');
    const content = document.querySelector('.content');
    const cancelButton = document.getElementById('cancel-button');

    // Agrega un controlador de eventos al botón para mostrar u ocultar el formulario
    showFormButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (supplierForm.style.visibility === 'visible') {
            hideForm();
        } else {
            showForm();
        }
    });

    // Agrega un controlador de eventos al botón "Cancelar" para ocultar el formulario
    cancelButton.addEventListener('click', function () {
        hideForm();
    });

    function showForm() {
        supplierForm.style.visibility = 'visible';
        content.classList.add('floating');
    }

    function hideForm() {
        supplierForm.style.visibility = 'hidden';
        content.classList.remove('floating');
    }

    // Oculta el formulario inicialmente
    supplierForm.style.visibility = 'hidden';
</script>


</body>
</html>
