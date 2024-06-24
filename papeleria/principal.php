<?php
include('controladores/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Principal</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #3498db;
            color: #ecf0f1;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .content-wrapper {
            background-color: #ffffff;
            color: #2C3E50;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 1s, transform 1s;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            color: #3498db;
        }

        .main-footer {
            background-color: #2C3E50;
            color: #ecf0f1;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: left;
        }

        .social-icon {
            margin-right: 10px;
            color: #ecf0f1;
        }

        p {
            line-height: 1.6;
            margin-bottom: 15px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 2s, transform 2s;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s, transform 0.5s;
        }

        .section-title {
            color: #3498db;
            font-size: 24px;
            margin-top: 20px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s, transform 0.5s;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: scale(0.9);
            transition: opacity 1s, transform 1s;
        }
    </style>
</head>

<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Puedes agregar tu contenido principal aquí -->
        <div class="container">
            <h1>Bienvenidos</h1>

            <!-- Sección 1: ¿Qué hace una venta de papelería? -->
            <div class="section-title">¿Qué hace una venta de papelería?</div>
            <p>Una venta de papelería es un negocio que ofrece una amplia gama de productos para la oficina, la escuela y el hogar. Algunos de los productos que podrías encontrar incluyen:</p>
            <ul>
                <li>Material escolar: cuadernos, libretas, bolígrafos, lápices, colores, reglas, compases, calculadoras, etc.</li>
                <li>Material de oficina: papel para impresora, sobres, carpetas, archivadores, clips, grapas, etc.</li>
                <li>Productos de impresión: tinta para impresoras, cartuchos de tóner, papel fotográfico, etc.</li>
                <li>Libros y revistas: libros de texto, novelas, revistas de actualidad, etc.</li>
                <li>Material para manualidades: cartulinas, papeles de colores, tijeras, pegamento, etc.</li>
                <li>Otros productos: tarjetas de felicitación, regalos, artículos de decoración, etc.</li>
            </ul>

            <!-- Sección 2: ¿Qué servicios ofrece una venta de papelería? -->
            <div class="section-title">¿Qué servicios ofrece una venta de papelería?</div>
            <p>Además de la venta de productos, una papelería puede ofrecer una serie de servicios adicionales, como:</p>
            <ul>
                <li>Fotocopias e impresiones: en blanco y negro o a color, en diferentes tamaños y formatos.</li>
                <li>Encuadernación: de documentos, tesis, libros, etc.</li>
                <li>Plastificado: de documentos, fotos, etc.</li>
                <li>Envío de fax: a nivel nacional e internacional.</li>
                <li>Recarga de tarjetas telefónicas: de diferentes compañías.</li>
                <li>Pago de servicios: luz, agua, teléfono, etc.</li>
            </ul>

            <!-- Sección 3: ¿Cómo elegir una buena papelería? -->
            <div class="section-title">¿Cómo elegir una buena papelería?</div>
            <p>Al elegir una papelería, es crucial considerar los siguientes aspectos:</p>
            <ul>
                <li>La variedad de productos y servicios que ofrece.</li>
                <li>Los precios de los productos.</li>
                <li>La calidad de los productos.</li>
                <li>La atención al cliente.</li>
                <li>La ubicación de la papelería.</li>
            </ul>

            <!-- Sección 4: ¿Qué información debe incluir una página web de venta de papelería? -->
            <div class="section-title">¿Qué información debe incluir una página web de venta de papelería?</div>
            <p>Una página web de venta de papelería debe proporcionar la siguiente información:</p>
            <ul>
                <li>Información sobre la empresa: nombre, dirección, teléfono, correo electrónico, etc.</li>
                <li>Catálogo de productos: con fotos, descripciones y precios de los productos.</li>
                <li>Información sobre los servicios que ofrece la papelería.</li>
                <li>Formulario de contacto: para que los clientes puedan realizar consultas o pedidos.</li>
                <li>Política de envío y devolución de productos.</li>
                <li>Política de privacidad y cookies.</li>
            </ul>

            <!-- Sección 5: Consejos para aumentar las ventas de una papelería online -->
            <div class="section-title">Consejos para aumentar las ventas de una papelería online</div>
            <p>Para aumentar las ventas de una papelería online, se pueden seguir los siguientes consejos:</p>
            <ul>
                <li>Ofrecer precios competitivos.</li>
                <li>Realizar promociones y descuentos.</li>
                <li>Tener una buena política de envío y devolución de productos.</li>
                <li>Ofrecer un buen servicio de atención al cliente.</li>
                <li>Posicionar la página web en los buscadores.</li>
                <li>Utilizar las redes sociales para promocionar la papelería.</li>
            </ul>
        </div>
        <center>
            <img src="img/papeleria.jpg" alt="" width="400px">
        </center>
    </div>

    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="float-right d-none d-sm-block">
                <b>Versión</b> 3.1.0
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
            <strong>&copy; <?php echo date("Y"); ?> Papeleria</strong>
        </div>
    </footer>

    <!-- Bootstrap Modales -->
    <div class="modal fade" id="featuresModal" tabindex="-1" role="dialog" aria-labelledby="featuresModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="featuresModalLabel">Features</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Contenido del modal para Features -->
                    Contenido de la sección Features.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".content-wrapper, .section-title, p, ul li, img").forEach(function(element) {
                element.style.opacity = 5;
                element.style.transform = "translateY(0)";
            });
        });
    </script>
</body>

</html>