<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #eff1d4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex: 1;
            padding: 2rem;
        }

        .form-box {
            width: 100%;
            max-width: 400px;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 0.75rem;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 0.5rem;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 0.5rem;
            margin-top: 0.25rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            background-color: #fdfbd9;
            color: rgb(0, 0, 0);
            font-size: 1rem;
            cursor: pointer;
        }

        button:hover {
            background-color: #e6c4dd;
        }
    </style>
    <script>
        function validateForm(event) {
            const nombre = document.getElementById('nombre').value.trim();
            const apellido = document.getElementById('apellido').value.trim();
            const email = document.getElementById('email').value.trim();
            const mensaje = document.getElementById('mensaje').value.trim();
            
            if (!nombre || !apellido || !email || !mensaje) {
                alert('Todos los campos son obligatorios.');
                event.preventDefault();
                return false;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                alert('Por favor, ingrese un correo electrónico válido.');
                event.preventDefault();
                return false;
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.hamburger').addEventListener('click', function() {
                document.querySelector('.menu').classList.toggle('active');
            });
        });
    </script>
</head>
<body>
    <header class="menu">
        <div>
            <img src="../img/logo.png" width="100" alt="Foto logo">
        </div>
        <div class="hamburger">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <nav class="menu-items">
            <a href="../home/index.html">Inicio</a>
            <a href="../portfolio/index.html">Mi Portfolio</a>
            <a href="../contacto/index.php">Contacto</a>
            <a href="../sobremi/index.html">Sobre Mí</a>
            <a href="../servicios/index.html">Servicios</a>
        </nav>
    </header>
    <main>
        <h1>Contacto</h1>
    </main>
    <div class="container">
            <div class="form-box">
                <form id="contactForm" action="enviar_mensaje.php" method="POST" onsubmit="return validateForm(event)">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <button type="submit">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024</p>
        <a href="mailto:mirandapm@gmail.com">Contáctame aquí</a>
    </footer>
</body>
</html>
