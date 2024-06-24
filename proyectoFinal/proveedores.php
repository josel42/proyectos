<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}

include('controllers/conexion.php');
$conn = conectar();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Proveedor</title>
    <link rel="shortcut icon" href="img/logoS.png">
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/estiloC.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            padding: 20px;
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                        0 10px 10px rgba(0, 0, 0, 0.22);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], 
        input[type="number"],
        textarea,
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #ff4b2b;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #492D07;
        }
    </style>
</head>
<body>
    <?php include('estilos/dashboard.php'); ?>
    <div class="container">
        <h2>Agregar Proveedor</h2>
        <form action="controllers/proveedor/agregar_proveedor.php" method="post">
            <label for="nombre">Nombre del Proveedor:</label>
            <input type="text" id="nombre" name="nombre" required>
            
            <label for="telefono">Teléfono:</label>
            <input type="number" id="telefono" name="telefono" required>
            
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="direccion">Dirección:</label>
            <textarea id="direccion" name="direccion" required></textarea>
            
            <button type="submit">Agregar Proveedor</button>
            <a href="verProveedores.php" class="btn btn-secondary">Ver Proveedores</a>
        </form>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const mensaje = urlParams.get('mensaje');
            const error = urlParams.get('error');

            if (mensaje === 'proveedor_agregado') {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Proveedor agregado exitosamente.'
                });
            } else if (error === 'error_agregar') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al agregar el proveedor. Inténtelo de nuevo.'
                });
            }
        });
    </script>
</body>
</html>
