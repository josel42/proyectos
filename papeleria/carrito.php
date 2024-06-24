<?php
include('controladores/navbar.php');
include('controladores/contConfigCarrito.php');

$contadorFactura = 1;
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

        h2 {
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

    <!-- Contenido Principal -->
    <div class="container mt-4" style="color: #ffffff;">
        <h1>Carrito de Compras</h1>

        <!-- Formulario para agregar productos a la factura -->
        <form method="post" action="">
            <div class="form-group">
                <label for="usuario">Seleccionar Usuario:</label>
                <select class="form-control" id="usuario" name="usuario" required>
                    <?php
                    // Obtener los usuarios desde la base de datos
                    $usuarios = getUsuarios();

                    foreach ($usuarios as $usuario) {
                        echo "<option value='{$usuario['idUsuario']}'>{$usuario['nombreUsuario']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="producto">Seleccionar Producto:</label>
                <select class="form-control" id="producto" name="producto" required>
                    <?php
                    // Obtener los productos desde la base de datos
                    $productos = getProductos();

                    foreach ($productos as $producto) {
                        echo "<option value='{$producto['idProducto']}'>{$producto['nombreProducto']}</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="agregarFactura">Añadir a la Factura</button>
        </form>
        <!-- Fin del formulario -->

        <h2>Factura</h2>
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
                    <th>Acciones</th>
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
                        echo "<td>
                        <form method='post' action=''>
                            <input type='hidden' name='factura' value='{$filaFactura['idFactura']}'>
                            <button type='submit' class='btn btn-danger' name='borrarFactura'>Borrar</button>
                        </form>
                    </td>";
                        echo "</tr>";

                        // Incrementa el contador de factura
                        $contadorFactura++;
                    }
                } else {
                    echo "<tr><td colspan='8'>No hay datos en la factura.</td></tr>";
                }

                $conexion->close();
                ?>
            </tbody>
        </table>
        <!-- Botón para comprar la factura -->
        <form method="post" action="">
            <button type="submit" class="btn btn-success" name="comprarFactura">Comprar</button>
        </form>
        <!-- Fin de la Tabla de Factura -->

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>