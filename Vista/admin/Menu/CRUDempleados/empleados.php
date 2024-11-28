<?php

require '../../config/config2.php';
require '../../config/config.php';

include ('../../config/controladores/empleados/listado_empleado.php');

include  ('../parte1.php'); 


?>


<?php include '../../headerside.php'?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Listado de Empleados
                        <a href="nuevo_empleado.php">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-create">
                            <i class="fa fa-plus"></i> Agregar Nuevo
                        </button></a>
                    </h1>
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
                    <div class="card card-outline card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Empleados registrados</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body" style="display: block;">
                           <div class="table table-responsive">
                               <table id="example1" class="table table-bordered table-striped table-sm">
                                   <thead>
                                   <tr>
                                    <th><center>Nro</center></th>
                                    <th><center>Nombres</center></th>
                                    <th><center>Celular</center></th>
                                    <th><center>DNI</center></th>
                                    <th><center>Email</center></th>
                                    <th><center>Cargo</center></th>
                                    <th><center>Salario</center></th>
                                    <th><center>Acciones</center></th>
                                   </tr>
                                   </thead>
                                   <tbody>
                                        <?php $contador = 0; ?>
                                        <?php foreach($empleados_datos as $empleado_dato){?>
                                            <tr>
                                                <td><center><?php echo $contador = $contador + 1;?></center></td>
                                                <td><center><?php echo $empleado_dato['Nombre']. ' ' . $empleado_dato['Apellido'];?></center></td>
                                                <td><center><?php echo $empleado_dato['Telefono']?></center></td>
                                                <td><center><?php echo $empleado_dato['dni']?></center></td>
                                                <td><center><?php echo $empleado_dato['Correo']?></center></td>
                                                <td><center><?php echo $empleado_dato['Cargo']?></center></td>
                                                <td><center><?php echo $empleado_dato['salario']?></center></td>
                                                 <td><center>
                                                    <div class="btn-group">
                                                        <a href="update.php?id=<?php echo $empleado_dato['idEmpleado']?>" type="button" class="btn btn-success btn-sm"><i class="fa fa-pencil-alt"></i></a>
                                                        <a href="delete.php?id=<?php echo $empleado_dato['idEmpleado']?>" type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </td></center>
                                            </tr>
                                       <?php } ?>
                                </tbody>
                                   </tfoot>
                               </table>
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

<?php include ('../parte2.php'); ?>
<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>



<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Empleados",
                "infoEmpty": "Mostrando 0 a 0 de 0 Empleados",
                "infoFiltered": "(Filtrado de _MAX_ total Empleados)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Empleados",
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


    <script>
    const toggleButton = document.querySelector('.toggle');
    // Obtén una referencia al elemento con clase "profile"

    // Agrega un controlador de eventos al botón de alternancia
    toggleButton.addEventListener('click', function () {
        if (profileElement) {
            profileElement.style.visibility = profileElement.style.visibility === 'hidden' ? 'visible' : 'hidden';
        }
    });

    // Obtén una referencia al elemento con clase "profile"
    const profileHeading = document.querySelector('.profile h4');
    const profileDescription = document.querySelector('.profile p');

    // Agrega un controlador de eventos al botón de alternancia
    toggleButton.addEventListener('click', function () {
        if (profileHeading && profileDescription) {
            if (profileHeading.style.visibility === 'hidden' || profileHeading.style.visibility === '') {
                profileHeading.style.visibility = 'visible';
                profileDescription.style.visibility = 'visible';
            } else {
                profileHeading.style.visibility = 'hidden';
                profileDescription.style.visibility = 'hidden';
            }
        }
    });
    </script>
    <script>
        
    // Obtén una referencia al botón y al formulario
    const showFormButton = document.getElementById('show-form-btn');
    const supplierForm = document.querySelector('.supplier-form');
    const content = document.querySelector('.content');
    const cancelButton = document.getElementById('cancel-button');

    // Agrega un controlador de eventos al botón para mostrar u ocultar el formulario
    showFormButton.addEventListener('click', function (e) {
        e.preventDefault();

        if (supplierForm.style.visibility === 'visible') {
            hideForm();
        } else {
            showForm();
        }
    });

    // Agrega un controlador de eventos al botón "Cancelar" para ocultar el formulario
    cancelButton.addEventListener('click', function () {
        hideForm();
    });

    function showForm() {
        supplierForm.style.visibility = 'visible';
        content.classList.add('floating');
    }

    function hideForm() {
        supplierForm.style.visibility = 'hidden';
        content.classList.remove('floating');
    }

    // Oculta el formulario inicialmente
    supplierForm.style.visibility = 'hidden';
</script>


</body>
</html> 