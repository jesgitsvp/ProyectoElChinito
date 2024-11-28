<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP    ;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';
require '../phpmailer/src/Exception.php';
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $file = $_FILES['file'];

    // Validar entrada
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($file['tmp_name'])) {
        die('Datos invalidos.');
    }

    // Crear instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF; //SMTP::DEBUG_OFF;                     //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = MAIL_USER;                     //SMTP username
            $mail->Password   = MAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;  

        // Remitente y destinatario
        $mail->setFrom('polleriaelchinito237@gmail.com', 'El Chinito');
        $mail->addAddress($email);

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Archivo adjunto';
        $mail->Body    = 'Por favor encuentra el archivo adjunto.';

        // Añadir el archivo adjunto
        $mail->addAttachment($file['tmp_name'], $file['name']);

        // Enviar el correo
        $mail->send();
        echo 'Correo enviado con éxito';


    } catch (Exception $e) {
        echo "El correo no pudo ser enviado. Error: {$mail->ErrorInfo}";
    }
}
?>
