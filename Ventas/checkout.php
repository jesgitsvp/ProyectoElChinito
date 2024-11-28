<?php

require_once '../config/config.php';


$db = new Database();
$con = $db->conectar();

$productos = isset($_SESSION['carrito']['productos']) ? $_SESSION['carrito']['productos'] : null;

//print_r($_SESSION);

$lista_carrito = array();

if ($productos != null){
foreach($productos as $clave => $cantidad){
    $sql = $con->prepare("SELECT idProducto, Nombre, PrecioVenta, descuento, $cantidad AS cantidad FROM producto WHERE 
    idProducto = ? AND activo=1");
    $sql-> execute([$clave]);
    $lista_carrito[] = $sql->fetch(PDO::FETCH_ASSOC);
}
}    


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#bla" />
    <title>Checkout</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="Style_v.css" />
</head>

<body>

<!--ALERTAS-->
<!-- <section class="alerta">
    <br>
    <div class="alert position-sticky top-0 alert-primary hide" role="alert">
        !Producto Añadido al carrito!
    </div>

    <div class="alert position-sticky top-0 alert-danger remove" role="alert">
        !Producto eliminado del carrito!
    </div>
</section> -->

    <!-- MODAL DE CARRITO  -->


    <main>
        <div class="container">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr class="text" style="color: #FFA07A">
                            <th scope="col">Productos</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
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
                                <td><?php echo MONEDA . number_format($preciodesc,2,'.',','); ?></td>
                                <td>
                                    <input type="number" min="1" max="20" step="1" value="<?php echo $cantidad ?>"
                                    size="5" id="cantidad_<?php echo $_id; ?>"
                                    onchange="actualizaCantidad(this.value, <?php echo $_id; ?>)">
                                </td>

                                <td>
                                    <div id="subtotal_<?php echo $_id;  ?>" name="subtotal[]"><?php echo MONEDA . number_format($subtotal,2,'.',',');?></div>
                                    
                                </td>
                                <td><a href="#" id="eliminar" class="btn btn-warning btn-sm" data-bs-id="<?php echo $_id; ?>" data-bs-toggle="modal" data-bs-target="#eliminaModal">Eliminar</a></td>
                             </tr>
                            <?php } ?>

                            <tr>
                                <td colspan="3"></td>
                                <td colspan="2">
                                    <p class="h3" id="total"><?php echo MONEDA . number_format($total,2,'.',','); ?></p>
                                </td>
                            </tr>
                    </tbody>
                <?php } ?>
                </table>
            </div>
            <?php if($lista_carrito!=null){ ?>
            <div class="row">
                <div class="col-md-5 offset-md-7 d-grid gap-2">
                    <?php if(isset($_SESSION['user_cliente'])) { ?>
                        <a href="pago.php" class="btn btn-danger btn-lg">Realizar pago</a>
                    <?php } else { ?>
                        <a href="../login/login.php?pago" class="btn btn-danger btn-lg">Realizar pago</a>
                    <?php } ?>
                </div>
            </div>
            <?php }?>
        </div>

        
    </main>     

        <!-- Modal -->
    <div class="modal fade" id="eliminaModal" tabindex="-1" aria-labelledby="eliminaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminaModalLabel">ALERTA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Desea eliminar el producto de la lista?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button id="btn-elimina" type="button" class="btn btn-danger"  onclick="eliminar()">Eliminar</button>
            </div>
            </div>
        </div>
    </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
 integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" 
integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>

let eliminaModal=document.getElementById('eliminaModal')
eliminaModal.addEventListener('show.bs.modal',function(event){
    let button = event.relatedTarget
    let id = button.getAttribute('data-bs-id')
    let buttonElimina = eliminaModal.querySelector('.modal-footer #btn-elimina')
    buttonElimina.value = id
})

function actualizaCantidad(cantidad,id){
    let url = '../clases/actualizar_carrito.php'
    let formData = new FormData()
    formData.append('action','agregar')
    formData.append('id',id)
    formData.append('cantidad',cantidad)

    fetch(url,{
        method:'POST', 
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data => {  
        if(data.ok){

            let divsubtotal = document.getElementById('subtotal_'+id)
            divsubtotal.innerHTML = data.sub

            let total=0.00
            let list = document.getElementsByName('subtotal[]')

            for(let i = 0; i < list.length ; i++){
                total += parseFloat(list[i].innerHTML.replace(/[S/,]/g,''))
            }

            total= new Intl.NumberFormat('en-US',{
                minimumFractionDigits: 2
            }).format(total)
            document.getElementById('total').innerHTML = '<?php echo MONEDA; ?>' + total
        }
        else{
            let inputCantidad = document.getElementById('cantidad_'+id)
            inputCantidad.value = data.cantidadAnterior
            alert("No hay suficientes existencias");
        }
    })
}

function eliminar(){

    let botonElimina = document.getElementById('btn-elimina')
    let id = botonElimina.value
    let url = '../clases/actualizar_carrito.php'
    let formData = new FormData()
    formData.append('action','eliminar')
    formData.append('id',id)

    fetch(url,{
        method:'POST', 
        body: formData,
        mode: 'cors'
    }).then(response => response.json())
    .then(data => {  
        if(data.ok){
            location.reload()
        
        }
    })
}
</script>


</body>

</html>