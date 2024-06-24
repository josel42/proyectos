<?php
include('estilo/navbar.html');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosko Virtual</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="estilo/estiloNavbar.css">
    <!-- CSS para animaciones -->
    <style>
        .animacion {
            animation: fadeIn 2s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .pie-pagina {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            z-index: 9999;
        }
    </style>
</head>
<body>
    <div id="navbarContainer"></div>

    <center><h1 class="animacion">Bienvenido al Kiosko Virtual</h1></center>

    <div class="container">
        <div class="row">
            <div class="col-md-6 fw-bold">
                <h2>Nuestros Productos</h2>
                <p>¡Descubre nuestra amplia variedad de productos disponibles en el kiosko virtual! Desde snacks y bebidas hasta artículos de conveniencia, tenemos todo lo que necesitas para satisfacer tus antojos.</p>
            </div>
            <div class="col-md-6 fw-bold">
                <h2>Sobre Nosotros</h2>
                <p>Somos un kiosko virtual dedicado a ofrecer comodidad y variedad a nuestros clientes. Nuestro objetivo es brindar una experiencia de compra rápida y fácil, donde puedas encontrar tus productos favoritos sin salir de casa.</p>
            </div>
        </div>
    </div>
    <br>
    <br>
    <center><img src="img/kiosko.jpg" alt=""></center>

    

    <!-- Pie de página -->
    <div class="pie-pagina">
        <p>© 2024 Kiosko Virtual - Todos los derechos reservados.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
