<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$id = isset($_POST['idVenta']) ? $_POST['idVenta'] : null;

// Validar que el idProducto no esté vacío
if (empty($id)) {
    echo "El ID de la venta es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE venta SET activo=0 WHERE id = ?";
$params = [$id];


try {
    $stm = $con->prepare($sql);
    if ($stm->execute($params)) {
        echo "El estado de la venta se ha actualizado exitosamente.";
        
        // Redireccionando al listado productos
        header("Location: ../../../Menu/CRUDventas/ventas.php");
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>