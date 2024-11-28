<?php

require '../../config/config2.php';
require '../../config/config.php';
require '../../config/Database.php';

$db = new Database2();
$con = $db->conectar();

$sql = "SELECT idProducto,idCategoria, Nombre, Descripcion, Costo, PrecioVenta, descuento,Existencias, InvMinimo,InvMaximo FROM producto WHERE activo=1";
$resultadoProductos = $con->query($sql);
$productos = $resultadoProductos ->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT idProveedores, Nombre, Direccion, Telefono, Correo, RUC FROM proveedor";
$resultadoProveedores = $con->query($sql);
$proveedores = $resultadoProveedores ->fetchAll(PDO::FETCH_ASSOC);

include  ('../parte1.php'); 


?>

<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Registro de una nueva compra</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div style="display: flex">
                                <h5>Datos del producto </h5>
                                <div style="width: 20px"></div>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-buscar_producto">
                                    <i class="fa fa-search"></i>
                                    Buscar producto
                                </button>
                                <div class="modal fade" id="modal-buscar_producto">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #1d36b6;color: white">
                                                <h4 class="modal-title">Busqueda del producto</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="example" class="table table-bordered table-striped table-sm">
                                                        <thead>
                                                            <tr>
                                                                <th><center>Selecionar</center></th>
                                                                <th><center>Nro</center></th>
                                                                <th><center>Categoría</center></th>
                                                                <th><center>Nombre</center></th>
                                                                <th><center>Imagen</center></th>
                                                                <th><center>Stock</center></th>
                                                                <th><center>Precio compra</center></th>
                                                                <th><center>Precio venta</center></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            <?php foreach ($productos as $producto): ?>
                                                                <tr>
                                                                    <td>
                                                                        <button class="seleccionarProductoBtn form-control"
                                                                            data-idpro="<?= $producto['idProducto'] ?>"
                                                                            data-nombre="<?= $producto['Nombre'] ?>"
                                                                            data-costo="<?= $producto['Costo'] ?>"
                                                                            data-precio="<?= $producto['PrecioVenta'] ?>"
                                                                            data-stock="<?= $producto['Existencias'] ?>"
                                                                            data-categoria="<?= $producto['idCategoria'] ?>"
                                                                            onclick="seleccionarProducto(this)">Seleccionar
                                                                        </button>
                                                                    </td>
                                                                    <td><?= $producto['idProducto'] ?></td>
                                                                    <td><?= $producto['idCategoria'] ?></td>
                                                                    <td><?= $producto['Nombre'] ?></td>
                                                                    <td>
                                                                        <img src="" width="50px" alt="asdf">
                                                                    </td>
                                                                    <td><center><?= $producto['Existencias'] ?></center></td>
                                                                    <td><?= $producto['Costo'] ?></td>
                                                                    <td><?= $producto['PrecioVenta'] ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>
                            <br>
                            <div class="row" style="font-size: 12px">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Categoría:</label>
                                                <div style="display: flex">
                                                    <input class="invisible" style="display: none;" id="idProductoInput">
                                                    <input class="form-control" id="categoriaProductoInput" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Nombre del producto:</label>
                                                <input type="text" name="nombre" id="nombreProductoInput" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Precio compra:</label>
                                                <input type="number" name="costo" id="precioProductoInput" class="form-control" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="">Cantidad:</label>
                                                <input type="number" name="cantidad" id="cantidad" class="form-control"  min="1" >
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="">Stock:</label>
                                                <input type="number" name="stock" id="stockProductoInput" class="form-control" style="   background-color: #fff819" disabled>
                                            </div>
                                        </div>

                                    </div>


                                </div>

                            </div>

                            <br>

                            <div style="display: flex">
                                <h5>Datos del proveedor </h5>
                                <div style="width: 20px"></div>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#modal-buscar_proveedor">
                                    <i class="fa fa-search"></i>
                                    Buscar proveedor
                                </button>
                                <!-- modal para visualizar datos de los proveedor -->
                                <div class="modal fade" id="modal-buscar_proveedor">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header" style="background-color: #1d36b6;color: white">
                                                <h4 class="modal-title">Busqueda de proveedor</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table table-responsive">
                                                    <table id="example2" class="table table-bordered table-striped table-sm">
                                                        <thead>
                                                        <tr>
                                                            <th><center>Selecionar</center></th>
                                                            <th><center>Nro</center></th>
                                                            <th><center>Nombre del proveedor</center></th>
                                                            <th><center>Celular</center></th>
                                                            <th><center>RUC</center></th>
                                                            <th><center>Dirección</center></th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php foreach ($proveedores as $proveedor): ?>
                                                                <tr>
                                                                    <td>
                                                                        <button class="seleccionarProveedorBtn form-control"
                                                                            data-idproveedor="<?= $proveedor['idProveedores'] ?>"
                                                                            data-nombreprove="<?= $proveedor['Nombre'] ?>"
                                                                            data-ruc="<?= $proveedor['RUC'] ?>"
                                                                            onclick="seleccionarProveedor(this)">Seleccionar
                                                                        </button>
                                                                    </td>
                                                                    <td><?= $proveedor['idProveedores'] ?></td>
                                                                    <td><?= $proveedor['Nombre'] ?></td>
                                                                    <td><?= $proveedor['Telefono'] ?></td>
                                                                    <td><?= $proveedor['RUC'] ?></td>
                                                                    <td><?= $proveedor['Direccion'] ?></td>


                                                                    <?php endforeach; ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            </div>

                            <br>

                            <div class="row" style="font-size: 12px">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="text" id="idProveedorInput" hidden>
                                                <label for="">Nombre</label>
                                                <input type="text" id="nombreProveedorInput" class="form-control" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">RUC</label>
                                                <input type="text" id="rucProveedorInput" class="form-control" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button onclick="agregarProducto()" class="btn btn-primary">Agregar Producto</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Detalle Compra</h3>
                            </div>
                            <div class="col-md-12 d-flex" style="margin-top:15px">
                                <label style="margin:20px">Número de serie:   </label>
                                <input type="text" id="Numseriecompra">
                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="table table-responsive">
                                    <table id="tablaProductos" class="table-hover col-md-12">
                                        <thead>
                                        <tr>
                                            <th><center>Nro</center></th>
                                            <th><center>Producto</center></th>
                                            <th><center>Precio</center></th>
                                            <th><center>Cantidad</center></th>
                                            <th><center>Subtotal</center></th>
                                            <th><center>Acciones</center></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer d-flex">
                                    <div class="col-md-6">
                                        <button class="btn btn-primary"  id="Generarcompra">Generar compra</button>
                                        <button class="btn btn-warning" >Cancelar</button>
                                    </div>
                                    <div class="col-md-3 ml-auto">
                                        <input type="text" name="txttotal" id="totalpagar" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>

<?php include ('../parte2.php'); ?>
<?php include '../../footerside.php'?>

<script>
    function seleccionarProducto(btn) {
        // Obtener los datos del producto seleccionado desde los atributos personalizados
        var nombreProducto = btn.getAttribute('data-nombre');
        var precioProducto = btn.getAttribute('data-precio');
        var categoriaProducto = btn.getAttribute('data-categoria');
        var stockProducto = btn.getAttribute('data-stock');
        var idProduc = btn.getAttribute('data-idpro');


        // Actualizar los campos de entrada con los datos del producto
        document.getElementById('nombreProductoInput').value = nombreProducto;
        document.getElementById('precioProductoInput').value = precioProducto;
        document.getElementById('categoriaProductoInput').value = categoriaProducto;
        document.getElementById('stockProductoInput').value = stockProducto;
        document.getElementById('idProductoInput').value = idProduc;

    }
</script>

<script>
    function seleccionarProveedor(btn) {
        // Obtener los datos del proveedor seleccionado desde los atributos personalizados
        var nombreProveedor = btn.getAttribute('data-nombreprove');
        var rucProveedor = btn.getAttribute('data-ruc');
        var idProveedor = btn.getAttribute('data-idproveedor');


        // Actualizar los campos de entrada con los datos del proveedor
        document.getElementById('nombreProveedorInput').value = nombreProveedor;
        document.getElementById('rucProveedorInput').value =rucProveedor;
        document.getElementById('idProveedorInput').value = idProveedor;
   

    }
</script>



<script>
    var numeroFila = 1;
    var productos = [];

    function agregarProducto() {
        // Obtener el idProducto del formulario
        var idProducto = document.getElementById("idProductoInput").value;

        // Verificar si el input de cantidad está vacío
        var cantidadInput = document.getElementById("cantidad");
        var cantidadValor = cantidadInput.value.trim();

        if (cantidadValor === "") {
            alert("Ingrese una cantidad antes de agregar el producto.");
            return;
        }

        // Obtener el stock del producto del input
        var stockDisponible = parseInt(document.getElementById("stockProductoInput").value);

        // Verificar si el producto ya está en la tabla
        var productoExistente = productos.find(producto => producto.idProducto === idProducto);

        if (productoExistente) {
            // Si el producto ya existe, actualiza la cantidad y el subtotal en el array y en la tabla
            var cantidadExistente = productoExistente.cantidad;
            var cantidadNueva = parseInt(cantidadValor);

            // Verificar si la nueva cantidad supera el stock disponible
            if (cantidadExistente + cantidadNueva > stockDisponible) {
                alert("No hay suficiente stock disponible.");
                return;
            }

            productoExistente.cantidad = cantidadExistente + cantidadNueva;
            productoExistente.subtotal = parseFloat(productoExistente.precio) * productoExistente.cantidad;
            actualizarFila(productoExistente);

        } else {
            // Si el producto no existe, agrégalo a la tabla y al array
            var categoria = document.getElementById("categoriaProductoInput").value;
            var nombre = document.getElementById("nombreProductoInput").value;
            var precio = document.getElementById("precioProductoInput").value;
            var cantidad = parseInt(cantidadValor);

            // Verificar si la cantidad supera el stock disponible
            if (cantidad > stockDisponible) {
                alert("No hay suficiente stock disponible.");
                return;
            }

            // Calcular el subtotal
            var subtotal = parseFloat(precio) * cantidad;

            // Crear un objeto producto
            var producto = {
                idProducto: idProducto,
                categoria: categoria,
                nombre: nombre,
                precio: precio,
                cantidad: cantidad,
                subtotal: subtotal
            };

            // Agregar el producto al array y a la tabla
            productos.push(producto);
            agregarFila(producto);
        }

        // Limpiar los campos del formulario después de agregar el producto
        cantidadInput.value = "";
        actualizarTotal();
    }

    function agregarFila(producto) {
        // Obtener la tabla
        var tabla = document.getElementById("tablaProductos");

        // Crear una nueva fila y agregar celdas
        var fila = tabla.insertRow();
        fila.innerHTML = `<td>${numeroFila}</td>
                          <td style="display: none;">${producto.idProducto}</td>
                          <td>${producto.nombre}</td>
                          <td>${producto.precio}</td>
                          <td class="cantidad">${producto.cantidad}</td>
                          <td>${producto.subtotal}</td>
                          <td>
                              <div class="btn-group">
                                  <button class="btn btn-danger" onclick="eliminarFila(this)">Borrar</button>
                              </div>
                          </td>`;

        numeroFila++;
        actualizarTotal();
    }

    function actualizarFila(producto) {
        // Obtener la tabla
        var tabla = document.getElementById("tablaProductos");

        // Buscar la fila correspondiente al producto
        var filas = tabla.getElementsByTagName("tr");
        for (var i = 1; i < filas.length; i++) {
            var celdas = filas[i].getElementsByTagName("td");
            var idProductoEnFila = celdas[1].innerText;

            if (idProductoEnFila === producto.idProducto) {
                // Actualizar la cantidad, el subtotal y la celda de cantidad en la fila
                celdas[4].innerText = producto.cantidad;
                celdas[5].innerText = producto.subtotal;
                return;
            }
        }
        actualizarTotal();
    }

    function eliminarFila(button) {
        var fila = button.parentNode.parentNode.parentNode;
        var tabla = fila.parentNode;
        var rowIndex = fila.rowIndex;

        // Obtener el idProducto de la fila a eliminar
        var idProductoEliminar = fila.cells[1].innerText;

        // Eliminar la fila de la tabla
        tabla.deleteRow(rowIndex);

        // Reiniciar el contador global y actualizar las filas restantes
        numeroFila = 1;
        for (var i = 1; i < tabla.rows.length; i++) {
            tabla.rows[i].cells[0].innerText = numeroFila++;
        }

        // Eliminar el producto del array
        productos = productos.filter(producto => producto.idProducto !== idProductoEliminar);

        actualizarTotal();
    }

    function actualizarTotal() {
        // Obtener el input totalpagar
        var totalPagarInput = document.getElementById("totalpagar");

        // Calcular el total sumando los subtotales de los productos
        var total = 0;
        productos.forEach(function (producto) {
            total += producto.subtotal;
        });

        // Actualizar el valor del input totalpagar
        totalPagarInput.value = total;


    }


</script>
