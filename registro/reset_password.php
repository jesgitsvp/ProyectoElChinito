<?php
require '../Database.php';
require 'clientefunciones.php';
require '../config/config.php';

$user_id = $_GET['id'] ?? $_POST['user_id'] ?? '';
$token = $_GET['token'] ?? $_POST['token'] ?? '';

if($user_id == '' || $token ==''){

    header("Location: ../index.php");
    exit;

}

$db = new Database();
$con = $db->conectar();

$errors = [];

if(!verificatokenrequest($user_id,$token,$con)){
    echo "No se pudo verificar la informacion";
    exit;
} 



if (!empty($_POST)){
   
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);


    if(esNulo([$user_id, $token, $password,$repassword])){
        $errors[]="Debe llenar todos los campos";
    }

    if(!validapassword($password,$repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }


    if(count($errors)==0){
       $pass_hash = password_hash($password, PASSWORD_DEFAULT);
       if(actualizarpassword($user_id,$pass_hash,$con)){
            echo "Contraseña modificada.<br><a href='../index.php'>Pagina principal</a>";
            exit;
       } else{
        $errors[] = "Error al modificar contraseña. Intentalo nuevamente";
       }
    }

}




?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registro.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>Recupera tu contraseña</title>
</head>

<body>
    <a href="../login/login.php" class="boton-retroceso">
        <img src="izquierda.png" alt="Retroceder">
    </a>
    <div class="contenedores">
        <div class="contenedor-blanco">
            <div>
                <div class="logo">
                    <img class="logo" src="logoblanco.png" alt="logo">
                </div>

                <div class="contenedor-form">
                
                <?php mostrarMensajes($errors); ?>  

                <h4 class="display-7 fw-bold text-body-emphasis">Cambiar contraseña</h4>

                    <div class="form">
                        <form method="POST" action="reset_password.php" autocomplete="off">

                        <input type="hidden" name="user_id" id="user_id" value="<?= $user_id; ?>"/>
                        <input type="hidden" name="token" id="token" value="<?= $token; ?>"/>

                                
                            <div class="input-password">
                                <label for="password" class="form-label"><span class="text-danger">*</span>Nueva contraseña</label>
                                <input type="password" name="password" class="form-control" placeholder="Nueva contraseña" id="password" requireda >
                            </div>

                            <div class="input-password">
                                <label for="repassword" class="form-label"><span class="text-danger">*</span>Confirmar contraseña</label>
                                <input type="password" name="repassword" class="form-control" placeholder="Confirmar contraseña" id="repassword" requireda >
                            </div>


                            <div class="boton">
                                <button type="submit">Continuar </button>
                            </div>

                            <div class="register-link">
                                <a href="../login/login.php">Inicie sesión</a>
                             </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="contenedor-img"></div>
    </div>
</body>
</html>