<?php
require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $ruc = $_POST['ruc'];

    $sql = "INSERT INTO proveedor (Nombre,Direccion,Telefono,Correo,RUC) VALUES (?,?,?,?,?)";
    $stm = $con->prepare($sql);
    
    if ($stm->execute([$nombre, $direccion, $telefono, $correo, $ruc])) {
        $id = $con->lastInsertId();
    }

    header('location:../../../Menu/CRUDproveedores/proveedores.php');
}


?>
