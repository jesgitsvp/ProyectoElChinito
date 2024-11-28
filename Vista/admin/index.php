<?php 
    require 'config/config.php';
    require 'config/Database.php';
    require 'clases/adminfunciones.php';

    $db=new Database2();
    $con = $db -> conectar();

    //$password = password_hash('admin',PASS//RD_DEFAULT);
    //$sql = "INSERT INTO admin (usuario, password, nombre, email, activo, fecha_alta)
    //VALUES ('admin','$password','Administrador','adminrojas@gmail.com','1',NOW())";

    //$con->query($sql);

    $errors=[];

    if(!empty($_POST)){
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        if(esNulo([$usuario,$password])){
            $errors[]="Debe llenar todos los campos";
        }

        if(count($errors)==0){
            $errors[]=login($usuario,$password,$con);

        }
    }
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css" crossorigin="">
    <link rel="stylesheet" href="estilos.css">
    <title>Login</title>
</head>
<body>
    <div class="login">

        <img src="img/Fondo_2.png" alt="image" class="login_bg">

        <form action="index.php" method="post" class="login_form" autocomplete="off">

            <h1 class="login_title">Inicio</h1>


            <div class="login_inputs">

                <div class="login_box">
                    <input type="text" placeholder="Usuario" name="usuario" required class="login_input" autofocus>
                    <i class="ri-mail-fill"></i>
                </div>

                <div class="login_box">
                    <input type="password" placeholder="Contraseña" name="password" required class="login_input">
                    <i class="ri-lock-2-fill"></i>
                </div>

                <?php mostrarMensajes($errors);?>

            </div>

            <button type="submit" class="login_button" >Iniciar</button>
            
        </form>
    </div>
</body>
</html>
