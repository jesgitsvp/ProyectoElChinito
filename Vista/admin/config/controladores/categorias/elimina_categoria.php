<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : null;

// Validar que el id_categoria no esté vacío
if (empty($id_categoria)) {
    echo "El ID de la categoria es obligatorio.";
    exit; // Detiene la ejecución si el ID es nulo
}

// Actualiza solo el campo activo
$sql = "UPDATE categoria SET activo_categoria=0 WHERE id_categoria = ?";
$params = [$id_categoria];


try {
    $stm = $con->prepare($sql);
    if ($stm->execute($params)) {
        echo "El estado de la categoria se ha actualizado exitosamente.";
        
        // Redireccionando al listado productos
        header("Location: ../../../Menu/categorias/categorias.php");
    } else {
        echo "Error al ejecutar la consulta.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();

}
?>