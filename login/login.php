<?php

require '../Database.php';
require '../registro/clientefunciones.php';
require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$proceso = isset($_GET['pago']) ? 'pago' : 'login';

$errors = [];

if (!empty($_POST)){
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $proceso = $_POST['proceso'] ?? 'login';

    if(esNulo([$usuario,$password])){
        $errors[]="Debe llenar todos los campos";
    }

    if(count($errors)==0){
    $errors[] = login($usuario, $password, $con, $proceso);   
    }

}

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>

<body>

<div class="wrapper">
        <form action="login.php" method="POST" autocomplete="off">
            <h1>Iniciar sesion </h1>
            
            <?php mostrarMensajes($errors); ?>

            <input type="hidden" name="proceso" value="<?php echo $proceso; ?>">

            <div class="input-box">
                <input type="text" placeholder="Usuario" name="usuario">

            </div>
            <div class="input-box">
                <input type="password" placeholder="Contraseña" name="password">

            </div>

            <div class="remember-forgot">
                <a href="../registro/recupera.php">¿Olvidaste tu contraseña?</a>
            </div>

            <div>
            <a href="../Ventas/diseno_v.php">
            <button type="submit" class="btn">Iniciar sesion</button>
            </a>
            </div>

            <div class="register-link">
                <p>¿No tienes una cuenta?<a 
                href="../registro/registro.php">Registrate</a></p>
            </div>

            
            
        </form>
</div>

</body>

</html>