<?php
include("estilo/navbar.html");
include('controllers/conexion.php');
include('controllers/inserPro.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <center>
        <h1 style="color: #3b0466;">Productos</h1>
    </center>

    <form class="mt-3" method="post" enctype="multipart/form-data">
        <div class="mb-3 row">
            <label class="form-label col-sm-3 fw-bold">Nombre Producto:</label>
            <div class="col-sm-3">
                <select class="form-control" name="nombrePro" id="nombrePro" required>
                    <option value="">Seleccione un producto</option>
                    <option value="Cuaderno">Cuaderno</option>
                    <option value="Carpeta">Carpeta</option>
                    <option value="Lapiz">Lápiz</option>
                    <option value="Cartulina">Cartulina</option>
                    <option value="Tijera">Tijera</option>
                </select>
            </div>
            <div class="col-sm-3">
                <input type="number" class="form-control" name="cantidadPro" id="cantidadPro" min="1" value="1" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3 fw-bold">Precio Producto:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="precioPro" id="precioPro" readonly required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3 fw-bold">Stock Producto:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="stockPro" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3 fw-bold">Descripción Producto:</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" name="descripcionPro" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3 fw-bold">Foto del Producto:</label>
            <div class="col-sm-4">
                <input type="file" class="form-control" name="fotoProducto">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Registrar Producto</button>
    </form>

    <script>
        // Obtener el elemento select para el nombre del producto
        var nombreProSelect = document.getElementById("nombrePro");

        // Obtener el elemento input para la cantidad de productos
        var cantidadProInput = document.getElementById("cantidadPro");

        // Obtener el elemento input para el precio del producto
        var precioProInput = document.getElementById("precioPro");

        // Objeto con los precios predefinidos de los productos
        var precios = {
            "Cuaderno": 9.55,
            "Carpeta": 12.30,
            "Lapiz": 5.99,
            "Cartulina": 8.90,
            "Tijera": 7.88
        };

        // Función para actualizar el precio según el producto y la cantidad seleccionados
        function actualizarPrecio() {
            var selectedValue = nombreProSelect.value;
            var cantidad = cantidadProInput.value;
            if (selectedValue in precios) {
                precioProInput.value = (precios[selectedValue] * cantidad).toFixed(2);
            } else {
                precioProInput.value = "";
            }
        }

        // Agregar evento change al select para detectar cambios en la selección
        nombreProSelect.addEventListener("change", actualizarPrecio);

        // Agregar evento input al input de cantidad para detectar cambios en la cantidad
        cantidadProInput.addEventListener("input", actualizarPrecio);

        // Llamar a la función una vez al cargar la página para mostrar el precio inicial
        actualizarPrecio();
    </script>

    <h1 class="mt-5">Productos Registrados</h1>
    <table class="table mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Imagen de Producto</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $contador = 1;
            // Crear una nueva conexión a la base de datos para obtener los datos de los productos
            $conexion_mostrar = new mysqli($host, $usuario, $contrasena, $base_datos);

            // Verificar la conexión
            if ($conexion_mostrar->connect_error) {
                die("Error al conectar con la base de datos: " . $conexion_mostrar->connect_error);
            }

            // Consulta para obtener los datos de los productos
            $consulta = "SELECT idProducto, nombrePro, precioPro, stockPro, descripcionPro, MAX(fotoProducto) as fotoProducto FROM productos GROUP BY idProducto";
            $resultado = $conexion_mostrar->query($consulta);

            if ($resultado->num_rows > 0) {
                // Mostrar cada fila de resultados
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $contador++ . "</td>";
                    echo "<td>" . $fila['nombrePro'] . "</td>";
                    echo "<td>" . $fila['precioPro'] . "</td>";
                    echo "<td>" . $fila['stockPro'] . "</td>";
                    echo "<td>" . $fila['descripcionPro'] . "</td>";
                    // Mostrar la imagen de producto si está disponible
                    if ($fila['fotoProducto'] != NULL) {
                        echo '<td><img src="data:image/jpeg;base64,' . base64_encode($fila['fotoProducto']) . '"></td>';
                    } else {
                        echo "<td>No hay imagen</td>";
                    }
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No se encontraron productos registrados.</td></tr>";
            }

            // Cerrar la conexión
            $conexion_mostrar->close();
            ?>
        </tbody>
    </table>
    <form action="factura.php" method="post">
        <button type="submit" class="btn btn-danger">Factura</button>
    </form>
    </div>
    <!-- Pie de página -->
    <div class="pie-pagina">
        <p>© 2024 Kiosko Virtual - Todos los derechos reservados.</p>
    </div>
</body>

</html>