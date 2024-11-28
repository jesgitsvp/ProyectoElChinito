<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


class Mailer{

    function enviarCorreo($correo, $asunto, $cuerpo)
    {
    
        require '../phpmailer/src/PHPMailer.php';
        require '../phpmailer/src/SMTP.php';
        require '../phpmailer/src/Exception.php';    
        require_once '../config/config.php';

        $mail = new PHPMailer(true);
    
        try{
            
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_OFF;  //SMTP::DEBUG_OFF;                    //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = MAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = MAIL_USER;                     //SMTP username
            $mail->Password   = MAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = MAIL_PORT;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Correo emisor y nombre

            $mail->setFrom('polleriaelchinito237@gmail.com', 'Polleria El Chinito');
            
            //Correo receptor y nombre

            $mail->addAddress($correo);    
            
            //Contenido
            // $mail->addAddress('ellen@example.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Contenido
            $mail->isHTML(true);       //Establecer el formato de correo electrónico HTML
            $mail->Subject = $asunto; //Titulo del correo

            //Cuerpo del correo 
            $mail->Body    =  utf8_decode($cuerpo);
            $mail->setLanguage('es', '../phpmailer/language/phpmailer.lang-es.php');

            //Enviar correo
            if($mail->send()){
                return true;
            } else{
                return false;
            } 
            
            }catch (Exception $e) {
            echo "No se pudo enviar el mensaje. Error de envío: {$mail->ErrorInfo}";
            return false;
            }    






        }
    }

?>