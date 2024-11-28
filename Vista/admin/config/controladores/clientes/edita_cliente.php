<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$idCliente = isset($_POST['idCliente']) ? $_POST['idCliente'] : null;
$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$dni = isset($_POST['dni']) ? $_POST['dni'] : null;
$ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : null;
$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : null;
$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : null;

// Validar que el idCliente no esté vacío
if (empty($idCliente)) {
    echo "El ID del cliente es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza los campos en la tabla cliente
$sql_cliente = "UPDATE cliente SET nombres=?, apellidos=?, correo=?, telefono=?, ciudad=?, provincia=?, dni=? WHERE idCliente = ?";
$params_cliente = [$nombre, $apellido, $correo, $telefono, $ciudad, $provincia, $dni, $idCliente];

try {
    $stmt_cliente = $con->prepare($sql_cliente);
    if ($stmt_cliente === false) {
        throw new Exception("Error en la preparación de la consulta SQL para la tabla cliente.");
    }

    if ($stmt_cliente->execute($params_cliente)) {
        // Si la actualización en la tabla cliente fue exitosa, actualiza la tabla usuario_cliente
        $sql_usuario_cliente = "UPDATE usuario_cliente SET usuario=? WHERE id_cliente = ?";
        $params_usuario_cliente = [$usuario, $idCliente];

        $stmt_usuario_cliente = $con->prepare($sql_usuario_cliente);
        if ($stmt_usuario_cliente === false) {
            throw new Exception("Error en la preparación de la consulta SQL para la tabla usuario_cliente.");
        }

        if ($stmt_usuario_cliente->execute($params_usuario_cliente)) {
            echo "Actualización exitosa.";
            // Redireccionando al listado productos
            header("Location: ../../../Menu/CRUDclientes/clientes.php");

        } else {
            echo "Error al actualizar la tabla usuario_cliente.";
        }
    } else {
        echo "Error al actualizar la tabla cliente.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

?>
