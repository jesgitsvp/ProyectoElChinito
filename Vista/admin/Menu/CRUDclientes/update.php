<?php

require '../../config/config2.php';

require '../../config/config.php';

require '../../config/Database.php';



$db = new Database2();
$con = $db->conectar();


$id = $_GET['id'];

$sql = $con->prepare("SELECT idCliente,nombres,apellidos,correo,telefono,direccion,ciudad,provincia,dni 
FROM cliente WHERE idCliente = ? AND estatus=1");
$sql->execute([$id]);
$cliente = $sql->fetch(PDO::FETCH_ASSOC);

$sql_usuario = $con->prepare("SELECT * FROM usuario_cliente WHERE id_cliente = ?");
$sql_usuario->execute([$cliente['idCliente']]);
$datos_usuario = $sql_usuario->fetch(PDO::FETCH_ASSOC);


?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Editar datos cliente</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Llene los datos con cuidado</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                            <div class="col">
                                <div class="col-md-12">

                                    <form action="../../config/controladores/clientes/edita_cliente.php"  method="post" autocomplete="off">

                                    <input type="hidden" name="idCliente" value="<?php echo $cliente['idCliente']; ?>">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">Nombre:</label>
                                                            <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $cliente['nombres'] ?>"  maxlength="50" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="apellido" class="form-label">Apellido:</label>
                                                            <input type="text" id="apellido" name="apellido" class="form-control" value="<?php echo $cliente['apellidos'] ?>"  maxlength="50" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="correo" class="form-label" >Correo:</label>
                                                            <input type="email" id="correo" name="correo" class="form-control" value="<?php echo $cliente['correo'] ?>" required >
                                                        </div>
                                                    </div>
                                                </div>   

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="direccion" class="form-label">Direccion:</label>
                                                            <input type="text" id="direccion" name="direccion" class="form-control"value="<?php echo $cliente['direccion'] ?>" required maxlength="50">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="telefono" class="form-label" >Telefono:</label>
                                                            <input type="number" id="telefono" name="telefono" class="form-control" value="<?php echo $cliente['telefono'] ?>" required >
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="dni" class="form-label" >DNI:</label>
                                                            <input type="number" id="dni" name="dni" class="form-control" value="<?php echo $cliente['dni'] ?>" required >
                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="ciudad" class="form-label">Ciudad:</label>
                                                            <select name="ciudad" id="ciudad" class="form-control" required>
                                                                <option value="" disabled <?php echo empty($cliente['ciudad']) ? 'selected' : ''; ?>>Elija su ciudad</option>
                                                                <option value="ica" <?php echo $cliente['ciudad'] == 'ica' ? 'selected' : ''; ?>>Ica</option>
                                                                <option value="lima" <?php echo $cliente['ciudad'] == 'lima' ? 'selected' : ''; ?>>Lima</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="provincia" class="form-label">Provincia:</label>
                                                            <div class="input-provincia">
                                                                <select name="provincia" id="provincia" class="form-control" required>
                                                                    <option value="" disabled <?php echo empty($cliente['provincia']) ? 'selected' : ''; ?>>Seleccione su provincia</option>
                                                                </select>
                                                                <div class="invalid-feedback">Por favor, seleccione una provincia.</div>
                                                            </div>
                                                        </div>
                                                     </div>
                                                </div>  

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="usuario" class="form-label" >Usuario:</label>
                                                            <input type="" id="usuario" name="usuario" class="form-control" value="<?php echo $datos_usuario['usuario'] ?>" required >
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        


                                             
                                        </div>





                                        <hr>
                                        <div class="form-group">
                                            <a href="clientes.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit"  value="Guardar" class="btn btn-primary">Guardar cambios</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->




<?php include ('../parte2.php'); ?>
<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>

<script>
const ciudadSelect = document.getElementById('ciudad');
const provinciaSelect = document.getElementById('provincia');
const ciudadesProvincias = {
    ica: ['Chincha', 'Pisco', 'Ica', 'Palpa', 'Nazca'],
    lima: ['Miraflores', 'Breña'],
};

// Función para cargar provincias según la ciudad seleccionada
function cargarProvincias() {
    const ciudadSeleccionada = ciudadSelect.value.toLowerCase();
    const provincias = ciudadesProvincias[ciudadSeleccionada] || [];
    
    provinciaSelect.innerHTML = '<option value="" disabled selected>Seleccione su provincia</option>'; // Reiniciar opciones

    for (const provincia of provincias) {
        const option = document.createElement('option');
        option.value = provincia;
        option.text = provincia;
        provinciaSelect.appendChild(option);
    }

    // Establecer el valor de la provincia si ya está definido
    if ('<?php echo $cliente['provincia']; ?>') {
        provinciaSelect.value = '<?php echo $cliente['provincia']; ?>';
    }
}

// Evento para detectar cambios en la ciudad
ciudadSelect.addEventListener('change', function () {
    cargarProvincias();
});

// Cargar provincias al iniciar
if (ciudadSelect.value) {
    cargarProvincias();
}
</script>

<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
                "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
                "infoFiltered": "(Filtrado de _MAX_ total Roles)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Roles",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

