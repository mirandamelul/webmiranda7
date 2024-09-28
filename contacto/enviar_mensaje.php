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

    $servername = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "webmiranda"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    if (empty($errores)) {
        $to = "miranda.polito@comunidad.ub.edu.ar"; 
        $subject = "Nuevo mensaje de contacto";
        $body = "Nombre: $nombre\nApellido: $apellido\nCorreo: $email\nMensaje:\n$mensaje";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $sql = "INSERT INTO contacto (nombre, apellido, email, mensaje) VALUES ('$nombre', '$apellido', '$email', '$mensaje')";

            if ($conn->query($sql) === TRUE) {
                echo "Mensaje enviado con éxito y registrado en la base de datos.";
            } else {
                echo "Error al registrar el mensaje en la base de datos: " . $conn->error;
            }
        } else {
            echo "Error al enviar el mensaje.";
        }
    } else {
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }

    $conn->close();
}
?>
