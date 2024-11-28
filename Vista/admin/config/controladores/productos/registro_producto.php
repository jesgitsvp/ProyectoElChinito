<?php

require_once '../../Database.php';

$db = new Database2();
$con = $db->conectar();

$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$existencias = $_POST['existencias'];
$invminimo = $_POST['invminimo'];
$invmaximo = $_POST['invmaximo'];
$costo = $_POST['costo'];
$precio = $_POST['precio'];
$descuento = $_POST['descuento'];
$categoria = $_POST['categoria'];

if (!is_numeric($descuento)) {
    // Manejar el caso cuando el valor no es numérico
    // Puedes asignar un valor predeterminado o mostrar un mensaje de error
    $descuento = 0; // Ejemplo: asignar descuento cero si no es numérico
}



$sql = "INSERT INTO producto (Nombre,Descripcion,Existencias,InvMinimo,InvMaximo,Costo,PrecioVenta,descuento,idCategoria) VALUES (?,?,?,?,?,?,?,?,?)";
$stm = $con->prepare($sql);
if ($stm -> execute([$nombre,$descripcion,$existencias,$invminimo,$invmaximo,$costo,$precio,$descuento,$categoria])){
    $id = $con->lastInsertId();

    //Subir imagen principal

    if($_FILES['imagen_principal']['error'] == UPLOAD_ERR_OK){
        $dir = '../../../../img/productos/'. $id . '/';
        $permitidos = ['jpeg','jpg'];

        $arregloImagen = explode('.',$_FILES['imagen_principal']['name']); 
        $extension = strtolower(end($arregloImagen));

        if(in_array($extension, $permitidos)){
            if(!file_exists($dir)){
                mkdir($dir, 0777, true);
            }
            $ruta_img = $dir . 'principal.' . $extension;
            if(move_uploaded_file($_FILES['imagen_principal']['tmp_name'], $ruta_img)){
                echo"El archivo se cargó correctamente.";
            }else{
                echo "Error al cargar el archivo";
            }
            
        } else{
            echo"Archivo no permitido";
        }
    }else{
        echo"No enviaste archivo";
    }

    //Subir otras imagenes

    if(isset($_FILES['otras_imagenes'])){
        $dir = '../../../../img/productos/'. $id . '/';
        $permitidos = ['jpeg','jpg'];

        if  (!file_exists($dir)){
            mkdir($dir, 0777, true);

        }
         
        $contador = 1;

        foreach($_FILES['otras_imagenes']['tmp_name'] as $key=> $tmp_name){
            $fileName=$_FILES['otras_imagenes']['name'][$key];

            $arregloImagen = explode('.',$fileName); 
            $extension = strtolower(end($arregloImagen));

            if(in_array($extension, $permitidos)){
                
                $ruta_img = $dir . $contador . '.' . $extension;

                if(move_uploaded_file($tmp_name, $ruta_img)){
                    echo"El archivo se cargó correctamente. <br>";
                }else{
                    echo "Error al cargar el archivo";
                }
            }
            $contador++;
        }
    }

}


header('Location:../../../Menu/CRUDproductos/productos.php');






?>