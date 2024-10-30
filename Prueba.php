<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
   // El mensaje
$mensaje = "Línea 1\r\nLínea 2\r\nLínea 3";

// Si cualquier línea es más larga de 70 caracteres, se debería usar wordwrap()
$mensaje = wordwrap($mensaje, 70, "\r\n");

$headers = 'From: passwordreset@dondigital.app' . "\r\n" .
           'Reply-To: passwordreset@dondigital.app' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Enviarlo

    if(mail('yosoyjulian1@gmail.com', 'Mi título', $mensaje)){
        echo "The email message was sent.";
    }else{
        echo var_dump(error_get_last());
    }
    
?>
