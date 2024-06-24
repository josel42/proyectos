<?php
include('controladores/navbar.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
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
    </style>
</head>

<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Puedes agregar tu contenido principal aquí -->
        <div class="container">
            <h1>Factura</h1>
            <table id="facturaTable" class="table table-bordered table-striped">
                <!-- Contenido de la tabla de factura -->
                <thead>
                    <tr>
                        <!-- Agrega una columna para el contador de factura -->
                        <th>No. Factura</th>
                        <th>Nombre Usuario</th>
                        <th>Correo</th>
                        <th>Nombre Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $conexion = new mysqli("localhost", "root", "", "papeleria");

                    if ($conexion->connect_error) {
                        die("Conexión fallida: " . $conexion->connect_error);
                    }

                    // Consulta SQL para obtener datos de la factura
                    $sqlFactura = "SELECT * FROM factura";
                    $resultadoFactura = $conexion->query($sqlFactura);

                    // Inicializa el contador de factura
                    $contadorFactura = 1;

                    if ($resultadoFactura->num_rows > 0) {
                        while ($filaFactura = $resultadoFactura->fetch_assoc()) {
                            echo "<tr>";
                            // Usa el contador de factura
                            echo "<td>{$contadorFactura}</td>";
                            echo "<td>{$filaFactura['nombreUsuario']}</td>";
                            echo "<td>{$filaFactura['correo']}</td>";
                            echo "<td>{$filaFactura['nombreProducto']}</td>";
                            echo "<td>{$filaFactura['precio']}</td>";
                            echo "<td>{$filaFactura['cantidad']}</td>";
                            echo "<td>{$filaFactura['stock']}</td>";
                            echo "</tr>";

                            // Incrementa el contador de factura
                            $contadorFactura++;
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay datos en la factura.</td></tr>";
                    }

                    $conexion->close();
                    ?>
                </tbody>
            </table>
            <!-- Fin de la Tabla de Factura -->
            <center>
                <h1>SE HA REALIZADO LA COMPRA EXITOSAMENTE</h1>
            </center>
            <center>
            <a href="carrito.php" class="btn btn-success">Volver a Comprar</a>
            <a href="generarPDF.php" class="btn btn-info">Exportar PDF</a>
            </center>
        </div>
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

</body>

</html>