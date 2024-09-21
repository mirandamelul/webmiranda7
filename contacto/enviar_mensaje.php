<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errores = [];
    $nombre = $apellido = $email = $mensaje = "";

    // Función para sanitizar los datos del formulario
    function sanitizar($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validar nombre
    if (empty($_POST["nombre"])) {
        $errores[] = "El nombre es obligatorio.";
    } else {
        $nombre = sanitizar($_POST["nombre"]);
    }

    // Validar apellido
    if (empty($_POST["apellido"])) {
        $errores[] = "El apellido es obligatorio.";
    } else {
        $apellido = sanitizar($_POST["apellido"]);
    }

    // Validar correo electrónico
    if (empty($_POST["email"])) {
        $errores[] = "El correo electrónico es obligatorio.";
    } else {
        $email = sanitizar($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El formato del correo electrónico no es válido.";
        }
    }

    // Validar mensaje
    if (empty($_POST["mensaje"])) {
        $errores[] = "El mensaje es obligatorio.";
    } else {
        $mensaje = sanitizar($_POST["mensaje"]);
    }

    // Conectar a la base de datos
    $servername = "localhost";
    $username = "root"; // Por defecto, el usuario es "root" sin contraseña
    $password = "123456"; // Por defecto, no hay contraseña
    $dbname = "webmiranda"; // Nombre de tu base de datos

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Si no hay errores, enviar el correo y registrar en la base de datos
    if (empty($errores)) {
        // Enviar el correo
        $to = "miranda.polito@comunidad.ub.edu.ar";  // Reemplaza con tu dirección de correo
        $subject = "Nuevo mensaje de contacto";
        $body = "Nombre: $nombre\nApellido: $apellido\nCorreo: $email\nMensaje:\n$mensaje";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            // Insertar datos en la base de datos
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
        // Mostrar errores
        foreach ($errores as $error) {
            echo "<p>$error</p>";
        }
    }

    // Cerrar conexión
    $conn->close();
}
?>
