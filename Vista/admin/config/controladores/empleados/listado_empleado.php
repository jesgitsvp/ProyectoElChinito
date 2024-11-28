<?php
$sql_empleados = "SELECT * FROM empleado WHERE activo = 1 ";
$query_empleados = $pdo->prepare($sql_empleados);
$query_empleados->execute();
$empleados_datos = $query_empleados->fetchAll(PDO::FETCH_ASSOC);


?>