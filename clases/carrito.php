<?php

require '../config/config.php';

$datos['ok'] = false;

if(isset($_POST['id'])){

    $id = $_POST['id'];
    $cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] :1;
    $token = $_POST['token'];

    $token_tmp = hash_hmac('sha512', $id, KEY_TOKEN);

    if($token == $token_tmp && $cantidad > 0 && is_numeric($cantidad)){   

        if(isset( $_SESSION['carrito']['productos'][$id])){
            $cantidad += $_SESSION['carrito']['productos'][$id];

        }

        $db= new Database();
        $con =  $db ->conectar();

        $sql = $con->prepare("SELECT Existencias FROM producto WHERE idProducto=? AND activo=1 LIMIT 1");
        $sql-> execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $Existencias = $row['Existencias'];

        if($Existencias >= $cantidad){
            $datos['ok'] = true;
            $_SESSION['carrito']['productos'][$id]  = $cantidad;
            $datos ['numero'] = count($_SESSION['carrito']['productos']);

        }

    }

}

echo json_encode($datos);

?>
