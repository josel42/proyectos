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
    <!-- Incluir el contenido del dashboard -->
    <?php include('estilos/dashboardU.php'); ?>
    
    <!-- Contenido específico de la página de inicio -->
    <section class="home">
        <div class="container">
            <h1>Bienvenid@, <?php echo $usuario; ?> a nuestra página de Ferretería</h1>
            <div class="content">
                <p>En nuestra página de ferretería, encontrarás una amplia variedad de herramientas, materiales de construcción, y equipos para proyectos de bricolaje y profesionales.</p>
                <p>Nuestro objetivo es ofrecer productos de alta calidad a precios competitivos, además de proporcionar un excelente servicio al cliente.</p>
                <h2>¿Qué puedes hacer aquí?</h2>
                <ul>
                    <li><strong>Gestionar productos:</strong> Añade, edita y elimina productos de nuestro catálogo.</li>
                    <li><strong>Gestionar categorías:</strong> Organiza los productos en diferentes categorías para facilitar la búsqueda.</li>
                    <li><strong>Gestionar proveedores:</strong> Mantén actualizada la información de los proveedores.</li>
                    <li><strong>Gestionar usuarios:</strong> Administra los usuarios que tienen acceso a esta plataforma.</li>
                </ul>
                <h2>Nuestras ventajas</h2>
                <ul>
                    <li>Amplio catálogo de productos</li>
                    <li>Precios competitivos</li>
                    <li>Atención personalizada</li>
                    <li>Entrega rápida y segura</li>
                </ul>
                <h2>Contacto</h2>
                <p>Si tienes alguna pregunta o necesitas asistencia, no dudes en ponerte en contacto con nuestro equipo de soporte.</p>
                <p>Email: soporte@ferreteria.com | Teléfono: +123 456 7890</p>
            </div>
        </div>
    </section>
</body>
</html>
