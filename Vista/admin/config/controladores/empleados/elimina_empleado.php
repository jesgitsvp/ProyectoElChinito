<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$idEmpleado = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : null;

// Validar que el idProducto no esté vacío
if (empty($idEmpleado)) {
    echo "El ID del empleado es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE empleado SET activo=0 WHERE idEmpleado = ?";
$params = [$idEmpleado];


try {
    $stm = $con->prepare($sql);
    if ($stm->execute($params)) {
        echo "El estado del producto se ha actualizado exitosamente.";
        
        // Redireccionando al listado productos
        header("Location: ../../../Menu/CRUDempleados/empleados.php");
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>