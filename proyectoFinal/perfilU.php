<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}

include('controllers/conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Obtener los datos del usuario
$idUsuario = $_SESSION['idUsuario'];
$sql = "SELECT nombre, email, foto_perfil, rol FROM usuarios WHERE idUsuario = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);
mysqli_stmt_execute($stmt);
mysqli_stmt_bind_result($stmt, $nombre, $email, $foto_perfil, $rol);
mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);
mysqli_close($conn);

include('estilos/dashboardU.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/estiloP.css">
    <link rel="stylesheet" href="estilos/estiloC.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Estilos del Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content h2 {
            margin-bottom: 20px;
        }
        .modal-content label {
            display: block;
            margin: 10px 0 5px;
        }
        .modal-content input[type="text"],
        .modal-content input[type="email"],
        .modal-content input[type="password"],
        .modal-content input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .modal-content button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .modal-content button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="profile">
            <h1>Bienvenido a tu perfil</h1>
            <h2><?php echo htmlspecialchars($nombre); ?></h2>
            <?php
            if ($foto_perfil) {
                echo '<img src="data:image/jpeg;base64,' . base64_encode($foto_perfil) . '" alt="Foto de perfil">';
            } else {
                echo '<img src="ruta/a/imagen/default.jpg" alt="Foto de perfil">';
            }
            ?>
            <p><?php echo htmlspecialchars($email); ?></p>
            <div class="description">
                <p>Bienvenido <?php echo htmlspecialchars($rol); ?> a tu perfil personal. Aquí puedes ver y gestionar la información de tu cuenta.</p>
            </div>
            <div class="additional-info">
                <p>En esta sección puedes actualizar tus datos personales y gestionar tu cuenta. Asegúrate de mantener tu información actualizada para recibir las últimas novedades y servicios.</p>
            </div>
            <div class="buttons">
                <button id="editBtn">Editar Cuenta</button>
                <button class="delete" onclick="eliminarCuenta()">Eliminar Cuenta</button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form action="controllers/perfil/editar_cuenta.php" method="post" enctype="multipart/form-data">
                <h2>Editar Perfil</h2>
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                <label for="correo">Correo Electrónico:</label>
                <input type="email" name="correo" id="correo" value="<?php echo htmlspecialchars($email); ?>" required>
                <label for="contraseña">Contraseña:</label>
                <input type="password" name="contraseña" id="contraseña" placeholder="Deja en blanco para no cambiar">
                <label for="foto">Foto de Perfil:</label>
                <input type="file" name="foto" id="foto">
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("editModal");

        // Get the button that opens the modal
        var btn = document.getElementById("editBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function eliminarCuenta() {
            if (confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')) {
                window.location.href = 'controllers/perfil/eliminar_cuenta.php';
            }
        }

        // Función para obtener el valor de un parámetro en la URL
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Mostrar alerta según el valor del parámetro "mensaje"
        document.addEventListener("DOMContentLoaded", function() {
            var mensaje = getUrlParameter('mensaje');
            if (mensaje) {
                if (mensaje === 'perfil_actualizado') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Perfil actualizado exitosamente.'
                    });
                } else if (mensaje === 'error_actualizacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al actualizar el perfil. Inténtelo de nuevo.'
                    });
                } else if (mensaje === 'cuenta_eliminada') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Cuenta eliminada exitosamente.'
                    });
                } else if (mensaje === 'error_eliminacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al eliminar la cuenta. Inténtelo de nuevo.'
                    });
                }
            }
        });
    </script>
</body>

</html>
