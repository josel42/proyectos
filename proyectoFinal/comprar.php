<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}
?>
<?php
$usuario = $_SESSION['nombre'];
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio</title>
    <link rel="shortcut icon" href="img/logoS.png">
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/estiloC.css">
    <link rel="stylesheet" href="estilos/style.css"> <!-- Incluir el estilo del dashboard aquí también -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .container {
            padding: 20px;
            max-width: 900px;
            margin: auto;
            background-color: gray;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                        0 10px 10px rgba(0, 0, 0, 0.22);
        }
        p, ul {
            color: white;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        ul li::before {
            color: #4CAF50;
            margin-right: 8px;
        }
        .content {
            text-align: left;
            margin: 20px;
        }
    </style>
</head>
<body>
    <?php include('estilos/dashboardU.php'); ?>
    <h1>Comprar</h1>
</body>
</html>
