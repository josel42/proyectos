<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuarios</title>
    <link rel="shortcut icon" href="img/logoS.png">
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f7f8fc;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin-left: 250px;
            /* Ajuste para el sidebar */
        }

        /* Container */
        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 600px;
            width: 100%;
        }

        /* Form Title */
        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        /* Form Group */
        .form-label {
            font-size: 14px;
            color: #555;
        }

        .form-control {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            width: 100%;
        }

        /* Buttons */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        .btn-primary {
            background-color: #ff4b2b;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #492D07;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        /* Radio Buttons */
        .form-check-inline {
            display: inline-block;
            margin-right: 10px;
        }

        .form-check-label {
            font-size: 14px;
            color: #555;
        }

        /* Alerts */
        .alert {
            margin-top: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .alert-dismissible .btn-close {
            background: none;
            border: none;
            font-size: 20px;
            line-height: 1;
            color: #000;
        }
    </style>
</head>

<body>
    <?php include('estilos/dashboard.php'); ?>
    <div class="container">
        <h1><i class="fas fa-user-plus"></i> Crear Usuarios</h1>
        <form action="controllers/usuarios/crear_usuario.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="contraseña" name="contraseña" required>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto de Perfil</label>
                <input type="file" class="form-control" id="foto" name="foto" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="rolUsuario" name="rol" value="usuario" checked>
                        <label class="form-check-label" for="rolUsuario">Usuario</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" id="rolAdmin" name="rol" value="administrador">
                        <label class="form-check-label" for="rolAdmin">Administrador</label>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> Crear Usuario</button>
            <a href="ver_usuarios.php" class="btn btn-secondary"><i class="bi bi-person-lines-fill"></i>Ver Usuarios</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
                if (mensaje === 'cuenta_creada') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Usuario creado exitosamente.'
                    });
                } else if (mensaje === 'correo_existente') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'El correo electrónico ya está registrado.'
                    });
                } else if (mensaje === 'error_creacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al crear la cuenta. Inténtelo de nuevo.'
                    });
                } else if (mensaje === 'error_foto') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al subir la foto. Inténtelo de nuevo.'
                    });
                }
            }
        });
    </script>
</body>
</html>
