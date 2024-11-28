<?php

require '../Database.php';
require '../config/config.php';



$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;


$lista_carrito = array();

if ($productos != null){
foreach($productos as $clave => $cantidad){
    $sql = $con->prepare("SELECT idProducto, Nombre, PrecioVenta, descuento, $cantidad AS cantidad FROM producto WHERE 
    idProducto = ? AND activo=1");
    $sql-> execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
}
}else{
    header("Location: ../index.php");
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#bla" />
    <title>Ventas</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    
    <link rel="stylesheet" href="Style_v.css" />

</head>

<body>

<?php include '../menu.php';?>
    
    <main>
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <h4>Detalles de pago</h4>
                    <div id="paypal-button-container">    </div>

                </div>
                <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="text-danger">
                                <th scope="col">Productos</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody class="tbody">
                            <?php if($lista_carrito==null){
                                echo '<tr><td colspan="5" class="text-center"><b>Lista vacia</b></td></tr>';
                            } else {
                                $total = 0;
                                foreach($lista_carrito as $producto){
                                    $_id = $producto['idProducto'];
                                    $nombre = $producto['Nombre'];
                                    $precio = $producto['PrecioVenta'];
                                    $descuento= $producto['descuento'];
                                    $cantidad= $producto['cantidad'];
                                    $preciodesc= $precio - (($precio * $descuento)/100);
                                    $subtotal = $cantidad * $preciodesc;
                                    $total += $subtotal;
                                
                                ?>
                            
                                <tr>
                                    <td><?php echo $nombre ?></td>
                                    <td>
                                        <div id="subtotal_<?php echo $_id;  ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2,'.',',');?></div>
                                        
                                    </td>
                                </tr>
                                <?php } ?>

                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">
                                        <p class="h3 text-end" id="total"><?php echo MONEDA . number_format($total,2,'.',','); ?></p>
                                    </td>
                                </tr>
                        </tbody>
                    <?php } ?>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </main>     


<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
    crossorigin="anonymous"></script>

    <script src="https://www.paypal.com/sdk/js?client-id=ATtIh_sUwNXj36bwlqrcVDNI4NPYq6rengo0A5qR6kSO0lT2dTV2kvT3Rwl8j7wuRR4O22WQCHIE_bGl"></script>

    <script>
        paypal.Buttons({
            style:{
                color:'blue',
                shape:'pill',
                label:'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units:[{
                        amount:{
                            value:<?php echo $total; ?>
                        }
                    }]
                });
            },
            onApprove: function(data,actions){
                let url = '../clases/captura.php'
                actions.order.capture().then(function(detalles){

                    console.log(detalles)

                    let url = '../clases/captura.php'

                    return fetch(url,{
                        method:'post',
                        headers:{
                            'content-type':'application/json'
                        },
                        body: JSON.stringify({
                            detalles: detalles
                        })

                    }).then(function(response){
                        window.location.href="../completado.php?key=" + detalles ['id'];
                    })
                });
            },

            onCancel: function(data){
                alert("Pago cancelado")
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>

</body>

</html>