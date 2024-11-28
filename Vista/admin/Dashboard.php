<?php 
    
    require 'config/config2.php';

    require 'config/config.php';

    require 'config/Database.php';


    $db = new Database2();

    $con = $db->conectar();



    // Contar categorías activas
        $sql_categorias = "SELECT COUNT(*) as total FROM categoria WHERE activo_categoria = 1";
        $query_categorias = $con->prepare($sql_categorias);
        $query_categorias->execute();
        $result_categorias = $query_categorias->fetch(PDO::FETCH_ASSOC);
        $total_categorias = $result_categorias['total'];

        // Contar empleados activos
        $sql_empleados = "SELECT COUNT(*) as total FROM empleado WHERE activo = 1";
        $query_empleados = $con->prepare($sql_empleados);
        $query_empleados->execute();
        $result_empleados = $query_empleados->fetch(PDO::FETCH_ASSOC);
        $total_empleados = $result_empleados['total'];

        // Contar clientes activos
        $sql_clientes = "SELECT COUNT(*) as total FROM cliente WHERE estatus = 1";
        $query_clientes = $con->prepare($sql_clientes);
        $query_clientes->execute();
        $result_clientes = $query_clientes->fetch(PDO::FETCH_ASSOC);
        $total_clientes = $result_clientes['total'];

        // Contar productos activos
        $sql_productos = "SELECT COUNT(*) as total FROM producto WHERE activo = 1";
        $query_productos = $con->prepare($sql_productos);
        $query_productos->execute();
        $result_productos = $query_productos->fetch(PDO::FETCH_ASSOC);
        $total_productos = $result_productos['total'];

        // Contar ventas activas (si aplica)
        $sql_ventas = "SELECT COUNT(*) as total FROM venta WHERE activo = 1"; // Cambia 'activo' si es necesario
        $query_ventas = $con->prepare($sql_ventas);
        $query_ventas->execute();
        $result_ventas = $query_ventas->fetch(PDO::FETCH_ASSOC);
        $total_ventas = $result_ventas['total'];

?>

<?php include 'Menu/parte1.php'?>

<?php include 'headerside.php'; ?> <!-- SIDEBAR --> 



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0">Bienvenido al sistema Estefano Macotela </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->


    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            Contenido del sistema
            <br><br>

            <div class="row">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            
                        <h3><?php echo $total_categorias; ?></h3>
                        <p>Categorías Registrados</p>
                        </div>
                        <a href="<?php echo ADMIN_URL; ?>Menu/categorias/categorias.php">
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                        </a>
                        <a href="<?php echo ADMIN_URL; ?>Menu/categorias/categorias.php" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            
                        <h3><?php echo $total_empleados; ?></h3>
                        <p>Empleados Registrados</p>
                        </div>
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDempleados/empleados.php">
                            <div class="icon">
                                <i class="fas fa-address-card"></i>
                            </div>
                        </a>
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDempleados/empleados.php" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            
                        <h3><?php echo $total_clientes; ?></h3>
                            <p>Clientes Registrados</p>
                        </div>
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDclientes/clientes.php">                            <div class="icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                        </a>
                        <a  class="small-box-footer" href="<?php echo ADMIN_URL; ?>Menu/CRUDclientes/clientes.php">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                        
                        <h3><?php echo $total_ventas; ?></h3>
                        <p>Ventas Registradas</p>
                        </div>
                        <a href="Menu/CRUDventas/ventas.php">
                            <div class="icon">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                        </a>
                        <a href="Menu/CRUDventas/ventas.php" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            
                        <h3><?php echo $total_productos; ?></h3>
                        <p>Productos Registrados</p>
                        </div>
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDproductos/productos.php">
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                        </a>
                        <a href="<?php echo ADMIN_URL; ?>Menu/CRUDproductos/productos.php" class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>


                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            
                            <h3><br></h3>
                            <p>Configuracion</p>
                        </div>
                        <a href="<?php echo ADMIN_URL; ?>Menu/Configuracion/configuracion.php">
                            <div class="icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </a>
                        <a class="small-box-footer" href="<?php echo ADMIN_URL; ?>Menu/Configuracion/configuracion.php">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>



                <!-- 
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-dark">
                        <div class="inner">
                            
                            <h3>3</h3>
                            <p>Proveedores Registrados</p>
                        </div>
                        <a href="Menu/CRUDproveedores/proveedores.php">
                            <div class="icon">
                                <i class="fas fa-car"></i>
                            </div>
                        </a>
                        <a href=""  class="small-box-footer">
                            Más detalle <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>

                    --> 

            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->





<?php include 'footerside.php'; ?> <!--SIDEBAR-->
<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>
<?php     include  ('Menu/parte2.php'); ?>




</body>
</html>