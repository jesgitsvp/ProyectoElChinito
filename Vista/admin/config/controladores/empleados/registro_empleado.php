<?php
require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $cargo = $_POST['cargo'];
    $correo = $_POST['correo'];
    $dni = $_POST['dni'];
    $salario = $_POST['salario'];


    $sql = "INSERT INTO empleado (Nombre,Apellido,Cargo,Telefono,Correo,dni,salario, activo) VALUES (?,?,?,?,?,?,?,1)";
    $stm = $con->prepare($sql);
    
    if ($stm->execute([$nombre, $apellido, $cargo, $telefono,$correo, $dni,$salario])) {
        $id = $con->lastInsertId();
    }

    header('location:../../../Menu/CRUDempleados/empleados.php');
}


?>
