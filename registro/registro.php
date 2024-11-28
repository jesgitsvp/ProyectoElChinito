<?php

require '../Database.php';
require 'clientefunciones.php';
require '../config/config.php';


$db = new Database();
$con = $db->conectar();

$errors = [];

if (!empty($_POST)){
    $nombres = trim($_POST['nombres']);
    $apellidos = trim($_POST['apellidos']);
    $correo = trim($_POST['correo']);
    $dni = trim($_POST['dni']);
    $telefono = trim($_POST['telefono']);
    $ciudad = trim($_POST['ciudad']);
    $provincia = trim($_POST['provincia']);
    $direccion = trim($_POST['direccion']);
    $usuario = trim($_POST['usuario']);
    $password = trim($_POST['password']);
    $repassword = trim($_POST['repassword']);

    if(esNulo([$nombres,$apellidos,$correo,$dni,$telefono,$ciudad,$provincia,$usuario,$password,$repassword,$direccion])){
        $errors[]="Debe llenar todos los campos";
    }

    if(!esCorreo($correo)){
        $errors[] = "La direccion de correo no es valida";
    }

    if(!validapassword($password,$repassword)){
        $errors[] = "Las contraseñas no coinciden";
    }

    if(userExiste($usuario, $con)){
        $errors[] = "El nombre de usuario $usuario ya está en uso";
    }

    if(correoExiste($correo, $con)){
        $errors[] = "El correo electronico $correo ya está en uso";
    }

    if (!isset($_POST['ciudad'])) {
        $errors[] = "El campo ciudad no está definido";
    }
    

    if(count($errors)==0){

        $id = registraCliente([$nombres, $apellidos, $correo, $telefono, $dni, $ciudad, $provincia,$direccion], $con);

        if($id>0) {

            require 'Mailer.php';
            $mailer = new Mailer();
            $token = generartoken();
           

            $pass_hash = password_hash($password, PASSWORD_DEFAULT);

            $idusuario = registraUsuario([$usuario, $pass_hash, $token, $id],$con);

            if($idusuario > 0 ){

                $url = 'http://localhost/Pag_rojas2/registro' . '/activa_cliente.php?id=' .$idusuario.'&token=' . $token;
                $asunto = "Activar cuenta - Tienda online";
                $cuerpo = "Estimado $nombres: <br> Para continuar con el proceso de registro es indispensable
                que de click en la siguiente liga <a href='$url'>Activar cuenta</a>";

                if($mailer -> enviarCorreo($correo, $asunto, $cuerpo)){

                    echo"Para terminar el progreso de registro siga las instrucciones que le hemos enviado a la direccion de correo electronico $correo";

                    exit;
                }
            } else {
                    $errors[] = "Error al registrar usuario";
            }
                
        } else {
             $errors[] = "Error al registrar cliente";
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
    <title>Registro</title>
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

                <?php mostrarMensajes($errors); ?>


                <div class="contenedor-form">
                    <div class="form">
                        <form method="POST" action="registro.php" autocomplete="off">
                            <div class="input-nomape">
                                <div class="input-nombre">
                                    <label for="nombre" class="form-label"><span class="text-danger">*</span>Nombres</label>
                                    <input type="text" name="nombres" class="form-control" id="nombre" placeholder="Nombres">
                                </div>
                                <div class="input-apellidos ">
                                    <label for="apellidos" class="form-label"><span class="text-danger">*</span>Apellidos</label>
                                    <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="Apellidos">
                                </div>
                            </div>
                            <div class="input-email">
                                <label for="email" class="form-label"><span class="text-danger">*</span>Correo electronico</label>
                                <input type="email" name="correo" class="form-control" id="correo" placeholder="name@example.com">
                                <span id ="validaCorreo" class= "text-danger" ></span>  
                            </div>
                            <div class="input-nomape">
                            <div class="input-contraseña">
                                <label for="dni" class="form-label"><span class="text-danger">*</span>DNI</label>
                                <input type="text" name="dni" class="form-control" id="dni" >
                                <span id ="validaDni" class= "text-danger" ></span>

                            </div>
                            <div class="input-numero">
                                <label for="numerotel" class="form-label"><span class="text-danger">*</span>Teléfono</label>
                                <input type="tel" name="telefono" class="form-control" id="numerotel" placeholder="Teléfono"
                                    maxlength="9" pattern="9[0-9]{8}" requireda>
                                <span class="error-message">El número debe comenzar con 9 y tener 8 dígitos
                                    adicionales.</span>
                            </div>
                            </div>
                            <div class="input-contraseña">
                                <label for="direccion" class="form-label"><span class="text-danger">*</span>Direccion</label>
                                <input type="text" name="direccion" class="form-control" id="direccion" >
                                <span id ="direccion" class= "text-danger" ></span>

                            </div>

                            <div class="input-ciupro">
                                <div class="input-ciudad">
                                    <label for="ciudad" class="form-label"><span class="text-danger">*</span>Ciudad</label><br>
                                    <select name="ciudad" id="ciudad" class="form-select" required>
                                        <option value="" selected disabled>Elija su ciudad</option>
                                        <option value="ica">Ica</option>
                                        <option value="lima">Lima</option>
                                    </select>
                                    <div class="invalid-feedback">Por favor, seleccione una ciudad.</div>
                                </div>

                                <div class="input-provincia">
                                    <label for="provincia" class="form-label"><span class="text-danger">*</span>Provincia</label><br>
                                    <select name="provincia" id="provincia" class="form-select" required>
                                        <option value="" selected disabled>Seleccione su provincia</option>
                                    
                                    </select>
                                    <div class="invalid-feedback">Por favor, seleccione una provincia.</div>
                                </div>
                            </div>
                            <div class="input-contraseña ">
                                    <label for="usuario"><span class="text-danger">*</span>Usuario</label>
                                    <input type="text" name="usuario" class="form-control" id="usuario" placeholder="Usuario" requireda>
                                    <span id ="validaUsuario" class= "text-danger" ></span>
                            </div>
                            <div class="input-contraseña ">
                                    <label for="password"><span class="text-danger">*</span>Contraseña</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Contraseña" requireda>
                            </div>
                            <div class="input-contraseña ">
                                    <label for="repassword" class="form-label"><span class="text-danger">*</span>Repetir contraseña</label>
                                    <input type="password" name="repassword" class="form-control" id="repassword" placeholder="Repetir contraseña" requireda>
                            </div>
                         
                            <div class="boton">
                                <input type="submit" value="Registrarse">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

        </div>
        <div class="contenedor-img"></div>
    </div>

    <script src="ciudad-provincia/ciudad.js"></script>

    <script>
        document.querySelector('.boton-retroceso').addEventListener('click', function () {
            window.location.href = this.getAttribute('href');
        });
    </script>

    <script>
        let txtUsuario = document.getElementById('usuario')
        txtUsuario.addEventListener("blur", function(){
            existeUsuario(txtUsuario.value)
        },false)

        let txtCorreo = document.getElementById('correo')
        txtCorreo.addEventListener("blur", function(){
            existeCorreo(txtCorreo.value)
        },false)

        let txtDni = document.getElementById('dni')
        txtDni.addEventListener("blur", function(){
            existeDni(txtDni.value)
        },false)


        function existeUsuario (usuario){
            let url="clienteAjax.php"
            let formData = new FormData()
            formData.append("action","existeUsuario")
            formData.append("usuario", usuario)

            fetch(url, {
                method:'POST',
                body:formData
            }).then (response => response.json())
            .then(data => {

                if(data.ok){
                    document.getElementById('usuario').value = ''
                    document.getElementById('validaUsuario').innerHTML = 'Usuario no disponible'
                } else{
                    document.getElementById('validaUsuario').innerHTML = ''

                }
            })
        }

        function existeCorreo (correo){
            let url="clienteAjax.php"
            let formData = new FormData()
            formData.append("action","existeCorreo")
            formData.append("correo", correo)

            fetch(url, {
                method:'POST',
                body:formData
            }).then (response => response.json())
            .then(data => {

                if(data.ok){
                    document.getElementById('correo').value = ''
                    document.getElementById('validaCorreo').innerHTML = 'El correo ya esta en uso'
                } else{
                    document.getElementById('validaCorreo').innerHTML = ''

                }
            })
        }

        function existeDni (dni){
            let url="clienteAjax.php"
            let formData = new FormData()
            formData.append("action","existeDni")
            formData.append("dni", dni)

            fetch(url, {
                method:'POST',
                body:formData
            }).then (response => response.json())
            .then(data => {

                if(data.ok){
                    document.getElementById('dni').value = ''
                    document.getElementById('validaDni').innerHTML = 'Este dni ya está registrado'
                } else{
                    document.getElementById('validaDni').innerHTML = ''

                }
            })
        }


    </script>

</body>

</html>