<?php
$para = "yosoyjulian1@gmail.com";
$asunto = "Asunto del correo";
$mensaje = "Este es el contenido del correo.";
$cabeceras = "From: remitente@ejemplo.com" . "\r\n" .
             "X-Mailer: PHP/" . phpversion();

// Enviar el correo
if (mail($para, $asunto, $mensaje, $cabeceras)) {
    echo "Correo enviado exitosamente.";
} else {
    echo "Error al enviar el correo.";
}
?>
