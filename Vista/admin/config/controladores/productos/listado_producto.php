<?php

$sql_productos = "SELECT p.idProducto, p.Nombre, p.Descripcion, c.nombre_categoria as NombreCategoria, p.Imagen, 
p.Costo, p.PrecioVenta, p.descuento, p.Existencias, p.InvMinimo, 
p.InvMaximo, p.FechaCaducidad, p.activo 
FROM producto p
INNER JOIN categoria c ON p.idCategoria = c.id_categoria
WHERE p.activo=1";

$query_productos = $pdo->prepare($sql_productos);
$query_productos->execute();
$productos_datos = $query_productos->fetchAll(PDO::FETCH_ASSOC);


?>