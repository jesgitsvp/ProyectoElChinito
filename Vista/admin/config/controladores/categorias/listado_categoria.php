<?php

$sql_categorias = "SELECT * FROM categoria WHERE activo_categoria=1";
$query_categorias = $pdo->prepare($sql_categorias);
$query_categorias->execute();
$categorias_datos = $query_categorias->fetchAll(PDO::FETCH_ASSOC);


?>