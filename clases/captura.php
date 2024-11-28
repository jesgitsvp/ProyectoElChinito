<?php

require '../config/config.php';

$db = new Database();
$con = $db->conectar();

$json = file_get_contents('php://input');
$datos = json_decode($json,true);

echo '<pre>';
print_r($datos);
echo '</pre>';


if(is_array($datos)){

    $id_transaccion = $datos['detalles']['id'];
    $total = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $status = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fecha_nueva = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $_SESSION['user_cliente'];

    $sql = $con->prepare("INSERT INTO venta (id_transaccion, status, email, id_cliente, total, fecha) VALUES (?,?,?,?,?,?)");
    $sql->execute([$id_transaccion, $status, $email, $id_cliente, $total, $fecha_nueva]);
    $id = $con->lastInsertId();

    if($id>0){
        $productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;
        
        if ($productos != null){
            foreach($productos as $clave => $cantidad){

                $sql = $con->prepare("SELECT idProducto, Nombre, PrecioVenta, descuento FROM producto WHERE 
                idProducto = ? AND activo=1");
                $sql-> execute([$clave]);
                $row_prod = $sql->fetch(PDO::FETCH_ASSOC);
                
                $precio = $row_prod['PrecioVenta'];
                $descuento= $row_prod['descuento'];
                $preciodesc= $precio - (($precio * $descuento)/100);

                $sql_insert = $con ->prepare("INSERT INTO detalleventa (id_venta, id_producto, nombre, precio, cantidad) VALUES (?,?,?,?,?)");
                if ($sql_insert-> execute([$id, $clave, $row_prod['Nombre'], $preciodesc, $cantidad])){
                    restarStock($row_prod['idProducto'], $cantidad, $con);
                }

            }

            // Consulta para obtener el correo del cliente
            $sql = $con->prepare("
                SELECT c.* 
                FROM cliente c
                WHERE c.idCliente = ?
            ");
            // Ejecutar la consulta 
            $sql->execute([$id_cliente]);

            // Obtener el resultado
            $cliente = $sql->fetch(PDO::FETCH_ASSOC);

            include 'enviar_email.php';
        }
        
        unset($_SESSION['carrito']);
   }

}

function restarStock($id,$cantidad,$con){

    $sql = $con->prepare("UPDATE producto SET Existencias = Existencias - ? WHERE idProducto = ? ");
    $sql ->execute([$cantidad, $id]);

}

