<?php
require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];

    $sql = "INSERT INTO categoria (nombre_categoria) VALUES (?)";
    $stm = $con->prepare($sql);
    
    if ($stm->execute([$nombre])) {
        $id = $con->lastInsertId();
    }

    header('location:../../../Menu/Categorias/categorias.php');
}


?>
