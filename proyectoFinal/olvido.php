<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurar Contraseña</title>
    <link rel="shortcut icon" href="img/logoS.png">
    <link rel="stylesheet" href="estilos/estilo.css">
</head>
<body>
    <h2>Restaurar Contraseña</h2>

    <div id="message" class="message"></div>

    <div class="container">
        <form id="resetPasswordForm" action="controllers/restaurar_contraseña.php" method="post">
            <h1>Introduce tu Correo Electrónico y Nueva Contraseña</h1>
            <input type="email" name="correo" placeholder="Correo Electrónico" required />
            <input type="password" name="contraNueva" placeholder="Contraseña Nueva" required />
            <input type="password" name="contraRepetir" placeholder="Repita la Contraseña" required />
            <button type="submit">Restaurar Contraseña</button>
            <a href="index.html">Cancelar</a>
        </form>
    </div>

    <footer>
        <p>
            Creado con <i class="fa fa-heart"></i> por
            <a target="_blank" href="https://florin-pop.com">Nuestro Equipo</a>
        </p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const messageDiv = document.getElementById('message');

            if (urlParams.has('success')) {
                messageDiv.innerHTML = '<p class="success">Tu contraseña ha sido restaurada exitosamente.</p>';
                messageDiv.style.display = 'block';
            } else if (urlParams.has('error')) {
                if (urlParams.get('error') === 'correo_no_encontrado') {
                    messageDiv.innerHTML = '<p class="error">No existe una cuenta con ese correo electrónico.</p>';
                } else if (urlParams.get('error') === 'contraseñas_no_coinciden') {
                    messageDiv.innerHTML = '<p class="error">Las contraseñas no coinciden. Por favor, inténtalo de nuevo.</p>';
                } else if (urlParams.get('error') === 'error_restauracion') {
                    messageDiv.innerHTML = '<p class="error">Hubo un error al restaurar la contraseña. Por favor, inténtalo de nuevo.</p>';
                }
                messageDiv.style.display = 'block';
            }
        });
    </script>
</body>
</html>
