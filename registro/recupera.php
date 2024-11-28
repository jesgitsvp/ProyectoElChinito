<?php
require '../Database.php';
require 'clientefunciones.php';
require '../config/config.php';


$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)){
   
    $correo = trim($_POST['correo']);

    if(esNulo([$correo])){
        $errors[]="Debe llenar todos los campos";
    }

    if(!esCorreo($correo)){
        $errors[] = "La direccion de correo no es valida";
    }



    if(count($errors)==0){
        if(correoExiste($correo,$con)){
            $sql = $con->prepare("SELECT usuario_cliente.idusuario, cliente.nombres FROM  usuario_cliente 
            INNER JOIN cliente ON usuario_cliente.id_cliente=cliente.idcliente
            WHERE cliente.correo LIKE ? LIMIT 1");
            $sql->execute([$correo]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $user_id = $row['idusuario'];
            $nombres = $row['nombres'];


            $token = solicitapassword($user_id, $con);

            if($token !== null){
                require 'Mailer.php';
                $mailer = new Mailer();

                $url = 'http://localhost/Pag_rojas2/registro' . '/reset_password.php?id=' .$user_id.'&token=' . $token;
                $asunto = "Recuperar contraseña - Tienda online";
                $cuerpo = "Estimado $nombres: <br> Si has solicitado el cambio de tuc ontraseña da click en el siguiente link <a href='$url'> $url </a>";
                $cuerpo.= "<br> Si no hiciste esta solicitud puedes ignorar este correo.";

                if($mailer -> enviarCorreo($correo, $asunto, $cuerpo)){

                    echo"<p><b>Correo enviado </b></p>";
                    echo"<p> Hemos enviado un correo electronico a la direccion $correo para restablecer la contraseña.</p>";
                    exit;


                }
               }
        
        } else {
            $errors[] = "No existe una cuenta asociada a este correo";
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
                    <img class="logo" src="Logochinito.png" alt="logo">
                </div>

                <div class="contenedor-form">
                
                <?php mostrarMensajes($errors); ?>

                <h4 class="display-7 fw-bold text-body-emphasis">Recuperar contraseña</h4>

                    <div class="form">
                        <form method="POST" action="recupera.php" autocomplete="off">
                                
                            <div class="input-email">
                                <label for="email" class="form-label"><span class="text-danger">*</span>Correo electronico</label>
                                <input type="email" name="correo" class="form-control" id="correo" required >
                            </div>

                            <div class="boton">
                                <input type="submit" value="Continuar">
                            </div>

                            <div class="register-link">
                                <p>¿No tienes una cuenta?<a 
                                href="../registro/registro.php">Registrate</a></p>
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