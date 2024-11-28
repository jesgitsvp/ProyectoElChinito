<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$idEmpleado = isset($_POST['idEmpleado']) ? $_POST['idEmpleado'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$cargo = isset($_POST['cargo']) ? $_POST['cargo'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$salario = isset($_POST['salario']) ? $_POST['salario'] : null;


// Validar que el idProducto no esté vacío
if (empty($idEmpleado)) {
    echo "El ID del empleado es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE empleado SET Nombre=?, Apellido=?, Cargo=?,Telefono=?,Correo=?,dni=?,salario=? WHERE idEmpleado = ?";
$params = [$nombre,$apellido,$cargo,$telefono,$correo,$dni,$salario,$idEmpleado];

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