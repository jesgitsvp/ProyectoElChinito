<?php
$sql_clientes = "SELECT * FROM cliente WHERE estatus = 1 ";
$query_clientes = $pdo->prepare($sql_clientes);
$query_clientes->execute();
$clientes_datos = $query_clientes->fetchAll(PDO::FETCH_ASSOC);


?>