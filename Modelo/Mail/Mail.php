<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail {

    public function enviarMailValidarRegistro($email, $keyValidacion) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = "palo1493@gmail.com";
$mail->Password = "d9a1oo30";
$mail->setFrom('palo1493@gmail.com', 'Activar usuario - Feria proyectos aula');
$mail->addAddress($email);
$mail->Subject = 'Activa tu usuario';
$mail->isHTML(true);
$mail->Subject = 'Activar usuario feria de proyectos de aula'; //asunto
$mail->Body = '<h1>Bienvenido a feria de proyectos de aula</h1><br> Ingresa al siguiente <a href="localhost/Proyectosdeaula/Validacion=' . $keyValidacion . '">ENLACE</a> para confirmar tu registro '; //mensaje


$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
        return $exito;
    }

}