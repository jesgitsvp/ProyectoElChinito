<?php
require '../../../Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $idProveedor = $_GET['id'];
    $db = new Database();
    $con = $db->conectar();

    // Realizar la consulta para eliminar el proveedor con el ID proporcionado
    $sql = $con->prepare("DELETE FROM proveedor WHERE idProveedores = ?");
    $sql->execute([$idProveedor]);

    // Redireccionar de nuevo a la página de proveedores después de eliminar
    header("Location: proovedores.php");
    exit;
}
