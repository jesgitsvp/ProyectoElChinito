<?php

$path = dirname(__FILE__);

require_once  $path . '/../Database.php';

$db = new Database();
$con = $db->conectar();

$sql = "SELECT nombre,valor FROM Configuracion";
$resultado = $con->query($sql);
$datosConfig = $resultado->fetchAll(PDO::FETCH_ASSOC);

$config = [];

foreach($datosConfig as $datoConfig){
    $config[$datoConfig['nombre']] = $datoConfig['valor'];
}


define("SITE_URL", "http://localhost/Pag_ElChinito");


define("KEY_TOKEN", "APR.wqc-354*");
define("MONEDA" , "S/");

// Iniciar sesión

// Datos para envío de correo electrónico
define("MAIL_HOST", $config['correo_smtp']);
define("MAIL_USER", $config['correo_email2']);
define("MAIL_PASS", $config['correo_password2']);
define("MAIL_PORT", $config['correo_puerto']);

session_start();
                                        
$num_cart = 0;

if(isset($_SESSION['carrito']['productos'])){
    $num_cart = count($_SESSION['carrito']['productos']);
}
?>
