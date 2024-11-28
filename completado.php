<?php

require 'Database.php';
require 'config/config.php';
$db = new Database();
$con = $db->conectar();

$id_transaccion= isset($_GET['key']) ? $_GET['key'] : '0';

$error = '';
if($id_transaccion ==  ''){
    $error = 'Error al procesar la petición';

} else{
    $sql = $con->prepare("SELECT count(id) FROM venta WHERE id_transaccion=? AND status=?");
        $sql-> execute([$id_transaccion,'COMPLETED']);
        if($sql ->fetchColumn()>0){
            $sql = $con->prepare("SELECT id,fecha,email,total FROM venta WHERE id_transaccion=? AND status=? LIMIT 1");
            $sql-> execute([$id_transaccion,'COMPLETED']);
            $row = $sql->fetch(PDO::FETCH_ASSOC);

            $idVenta = $row['id'];
            $total = $row['total'];
            $fecha = $row['fecha'];

            $sqlDet = $con-> prepare("SELECT nombre, precio, cantidad FROM detalleventa WHERE id_venta=?");
            $sqlDet-> execute([$idVenta]);

            //$sqlUser = $con-> prepare("SELECT correo FROM cliente WHERE idCliente=?");
            //$sql-> execute([$idCliente]);

        }else{
            $error = 'Error al comprobar la compra';
        }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Venta</title>
    <link rel="stylesheet" href="Style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/LogoChinito.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">

    
    </head>
        <body>
        <header>
        <!-- EMCABEZADO DE LA PAGINA WEB ZZZ-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-center">
            <div class="container-fluid mx-auto">

                <img id="img_ventas" src="Ventas/ventas_img/LogoChinito.png" alt="" class="mx-auto">

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                    aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse menu_responsi" id="navbarNavAltMarkup">

                    <div class="navbar-nav ms-auto menu_list">

                        

                        <a id="sube" class="nav-link active" aria-current="page" href="index.php">Inicio</a>

                        


                        <div class="collapse navbar-collapse menu_responsi_boton" id="navbarNavAltMarkup">
                            
                        <?php if(isset($_SESSION['user_id'])) { ?>
                            <div class="dropdown">
                                <button class="btn btn-danger btn-sm dropdown-toggle" type="button" id="btn_session" data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo $_SESSION['user_name']; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="btn_session">
                                    <li><a class="dropdown-item" href="../logout.php">Cerrar sesión</a></li>
                                </ul>
                            </div>  
                            <?php } else { ?>
                        <?php } ?>
                        </div>



                    </div>
                </div>
            </div>
        </nav>

    </header>
        <main>
            <div class="container">
                <?php if (strlen($error) > 0) { ?>
                    <div class="row">
                        <div class="col">
                            <?php  echo $error; ?>
                        </div>
                    </div>
                    
                    <?php } else { ?>
                    
                    <div class="row">
                        <div class="col">
                            <b>Folio de la compra: </b><?php echo $id_transaccion; ?> <br>
                            <b>Fecha de compra: </b><?php echo $fecha; ?> <br>
                            <b>Total: </b><?php echo MONEDA . number_format( $total,2,'.',','); ?> <br>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <table class=table>
                                <thead>
                                    <tr>
                                        <th>Cantidad</th>
                                        <th>Producto</th>
                                        <th>Importe</th>

                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php while($row_det = $sqlDet->fetch(PDO::FETCH_ASSOC)){ 
                                        $importe = $row_det['precio'] * $row_det['cantidad']; ?>
                                        
                                        <tr>
                                            <td><?php echo  $row_det['cantidad']; ?></td>
                                            <td><?php echo  $row_det['nombre']; ?></td>
                                            <td><?php echo MONEDA . number_format($importe); ?></td>

                                        </tr>

                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </main>
    </body>

</html>