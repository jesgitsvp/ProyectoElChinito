<?php

require_once '../Database.php';
require_once 'clientefunciones.php';
require '../config/config.php';


$datos = [];

if(isset($_POST['action'])){
    $action = $_POST['action'];

    $db = new Database();
    $con = $db -> conectar();

    if($action == 'existeUsuario')
    {
        $datos ['ok'] = userExiste($_POST['usuario'], $con);
        
    } elseif($action == 'existeCorreo') 
    {
        $datos ['ok'] = correoExiste($_POST['correo'], $con);

    } elseif($action == 'existeDni')
    {
        $datos ['ok'] = dniExiste($_POST['dni'], $con);
    }
}

echo json_encode($datos);








?>