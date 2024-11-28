<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$idCliente = isset($_POST['idCliente']) ? $_POST['idCliente'] : null;

// Validar que el idProducto no esté vacío
if (empty($idCliente)) {
    echo "El ID del cliente es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE cliente SET estatus=0 WHERE idCliente = ?";
$params = [$idCliente];


try {
    $stm = $con->prepare($sql);
    if ($stm->execute($params)) {
        echo "El estado del producto se ha actualizado exitosamente.";
        
        // Redireccionando al listado productos
        header("Location: ../../../Menu/CRUDclientes/clientes.php");
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>