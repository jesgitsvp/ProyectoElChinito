<?php
require '../../config/config2.php';

require '../../config/config.php';
require '../../config/Database.php';

$db = new Database2();
$con = $db->conectar();

$sql = "SELECT nombre,valor FROM Configuracion";
$resultado = $con->query($sql);
$datos = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach($datos as $dato){
    $config[$dato['nombre']] = $dato['valor'];
}


?>

<?php include '../parte1.php'?>
<?php include '../../headerside.php' ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">   
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Configuracion</h1>
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

                                    <form action="guardar.php"  method="post" autocomplete="off">

                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="nombre" class="form-label">SMTP:</label>
                                                            <input class="form-control" type="text" name="smtp" id="smtp" value="<?php echo $config['correo_smtp']; ?>">
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="apellido" class="form-label">Puerto:</label>
                                                            <input class="form-control" type="text" name="puerto" id="puerto" value="<?php echo $config['correo_puerto']; ?>">
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="correo" class="form-label" >Correo electronico:</label>
                                                            <input class="form-control" type="email" name="email" id="email" value="<?php echo $config['correo_email2']; ?>">
                                                            </div>
                                                    </div>
                                                </div>   

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="cargo" class="form-label">Contraseña:</label>
                                                            <input class="form-control" type="password" name="password" id="password" value="<?php echo $config['correo_password2']; ?>">
                                                            </div>
                                                    </div>
                                                </div>

                                            </div>
                                        


                                             
                                        </div>





                                        <hr>
                                        <div class="form-group">
                                            <a href="../../Dashboard.php" class="btn btn-secondary">Cancelar</a>
                                            <button type="submit"  value="GuardarConfig" class="btn btn-primary">Guardar Configuracion</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
</div>


<?php include ('../parte2.php'); ?>

<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>

<?php include'../../footerside.php' ?>

