<?php
require '../../config/config.php';
require '../../config/Database.php';

$db = new Database();
$con = $db->conectar();

$smtp = $_POST['smtp'];
$puerto = $_POST['puerto'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = $con->prepare("UPDATE Configuracion SET valor = ? WHERE nombre = ?");
$sql->execute([$smtp, 'correo_smtp']);
$sql->execute([$puerto, 'correo_puerto']);
$sql->execute([$email, 'correo_email']);
$sql->execute([$password, 'correo_password']);

?>


<?php include '../../headerside.php'; ?> <!-- SIDEBAR -->  
<link rel="stylesheet" href="configuracion.css">

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Configuracion actualizada</h1>

        <a href="configuracion.php">Regresar</a>
    </div>
</main>

<script src="<?php echo ADMIN_URL;?>Menu/menu.js"></script>
<?php include '../../footerside.php'; ?> <!--SIDEBAR-->
