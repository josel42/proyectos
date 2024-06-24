<?php
include("estilo/navbar.html");
include('controllers/conexion.php');
include('controllers/buscCli.php');

// Crear una nueva conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

// Consulta para obtener los productos
$consultaProductos = "SELECT * FROM productos";
$resultadoProductos = $conexion->query($consultaProductos);

// Verificar si la consulta se realizó correctamente
if ($resultadoProductos === FALSE) {
    die("Error en la consulta de productos: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            width: 100px;
            height: auto;
        }

        .container {
            margin: 20px;
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

        form {
            margin-bottom: 20px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>Generar Factura</h1>
    <form id="facturaForm" method="post" action="guardar_factura.php">
        <label for="nombreCliente">Nombre del Cliente:</label>
        <select name="nombreCliente" id="nombreCliente" required>
            <option value="">Seleccione un cliente</option>
            <?php
            // Mostrar opciones de clientes
            while ($fila = $resultadoClientes->fetch_assoc()) {
                echo "<option value='" . $fila['nombreCli'] . "'>" . $fila['nombreCli'] . "</option>";
            }
            ?>
        </select><br><br>
        <!-- Campo oculto para enviar el nombre del cliente seleccionado -->
        <input type="hidden" name="nombreCliente" value="<?php echo htmlspecialchars($_POST['nombreCliente'] ?? ''); ?>">

        <input type="submit" class="btn btn-secondary" value="Guardar">
    </form>


    <br>
    <h2 id="clienteSeleccionado">Cliente Seleccionado: </h2>
    <h2>Lista de Productos</h2>
    <table id="productosTable" border="1">
        <tr>
            <th>ID</th>
            <th>Nombre Producto</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Descripción</th>
            <th>Imagen</th>
        </tr>
        <?php
        // Mostrar los productos en la tabla
        mysqli_data_seek($resultadoProductos, 0); // Reiniciar el cursor del resultado
        while ($producto = $resultadoProductos->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $producto['idProducto'] . "</td>";
            echo "<td>" . $producto['nombrePro'] . "</td>";
            echo "<td>" . $producto['precioPro'] . "</td>";
            echo "<td>" . $producto['stockPro'] . "</td>";
            echo "<td>" . $producto['descripcionPro'] . "</td>";
            echo "<td><img src='data:image/jpeg;base64," . base64_encode($producto['fotoProducto']) . "' alt='Imagen del Producto' width='100' height='100'></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <form action="generar_pdf.php" method="post">
        <center><button type="submit">Generar PDF</button></center>
    </form>
    <!-- Pie de página -->
    <div class="pie-pagina">
        <p>© 2024 Kiosko Virtual - Todos los derechos reservados.</p>
    </div>

    <script>
        document.getElementById("facturaForm").addEventListener("submit", function(event) {
            // Evitar que el formulario se envíe de manera predeterminada
            event.preventDefault();
            // Obtener el nombre del cliente seleccionado
            var clienteSeleccionado = document.getElementById("nombreCliente").value;
            // Actualizar el texto con el cliente seleccionado
            document.getElementById("clienteSeleccionado").innerText = "Cliente Seleccionado: " + clienteSeleccionado;
        });
    </script>
</body>

</html>