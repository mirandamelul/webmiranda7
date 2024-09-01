<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $nombre = $apellido = $email = $mensaje = "";

    function sanitizar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (empty($_POST["nombre"])) {
        $errores[] = "El nombre es obligatorio.";
    } else {
        $nombre = sanitizar($_POST["nombre"]);
    }

    if (empty($_POST["apellido"])) {
        $errores[] = "El apellido es obligatorio.";
    } else {
        $apellido = sanitizar($_POST["apellido"]);
    }

    if (empty($_POST["email"])) {
        $errores[] = "El correo electrónico es obligatorio.";
    } else {
        $email = sanitizar($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El formato del correo electrónico no es válido.";
        }
    }

    if (empty($_POST["mensaje"])) {
        $errores[] = "El mensaje es obligatorio.";
    } else {
        $mensaje = sanitizar($_POST["mensaje"]);
    }

    if (empty($errores)) {
        $to = "miranda.polito@comunidad.ub.edu.ar"; 
        $subject = "Nuevo mensaje de contacto";
        $body = "Nombre: $nombre\nApellido: $apellido\nCorreo: $email\nMensaje:\n$mensaje";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            echo "Mensaje enviado con éxito.";
        } else {
            echo "Error al enviar el mensaje.";
        }
    } else {
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }
}
?>
