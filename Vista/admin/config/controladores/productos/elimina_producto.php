<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$idProducto = isset($_POST['idProducto']) ? $_POST['idProducto'] : null;

// Validar que el idProducto no esté vacío
if (empty($idProducto)) {
    echo "El ID del producto es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE producto SET activo=0 WHERE idProducto = ?";
$params = [$idProducto];

try {
    $stm = $con->prepare($sql);
    if ($stm->execute($params)) {
        echo "El estado del producto se ha actualizado exitosamente.";
        
        // Redireccionando al listado productos
        header("Location: ../../../Menu/CRUDproductos/productos.php");
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
