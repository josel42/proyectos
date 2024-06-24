<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}

include('controllers/conexion.php');
$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// Paginación
$productos_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $productos_por_pagina;

// Búsqueda
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT p.idProducto, p.nombre AS nombreProducto, p.descripcion, p.precio, p.stock, c.nombre AS nombreCategoria, pr.nombre AS nombreProveedor 
            FROM productos p
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria
            INNER JOIN proveedores pr ON p.idProveedor = pr.idProveedor
            WHERE p.nombre LIKE '%$search_query%' 
            OR c.nombre LIKE '%$search_query%' 
            OR pr.nombre LIKE '%$search_query%' 
            LIMIT $offset, $productos_por_pagina";
    $sql_total = "SELECT COUNT(*) as total 
                  FROM productos p
                  INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                  INNER JOIN proveedores pr ON p.idProveedor = pr.idProveedor
                  WHERE p.nombre LIKE '%$search_query%' 
                  OR c.nombre LIKE '%$search_query%' 
                  OR pr.nombre LIKE '%$search_query%'";
} else {
    $sql = "SELECT p.idProducto, p.nombre AS nombreProducto, p.descripcion, p.precio, p.stock, c.nombre AS nombreCategoria, pr.nombre AS nombreProveedor 
            FROM productos p
            INNER JOIN categorias c ON p.idCategoria = c.idCategoria
            INNER JOIN proveedores pr ON p.idProveedor = pr.idProveedor
            LIMIT $offset, $productos_por_pagina";
    $sql_total = "SELECT COUNT(*) as total 
                  FROM productos p
                  INNER JOIN categorias c ON p.idCategoria = c.idCategoria
                  INNER JOIN proveedores pr ON p.idProveedor = pr.idProveedor";
}

$result = mysqli_query($conn, $sql);
$result_total = mysqli_query($conn, $sql_total);
$total_productos = mysqli_fetch_assoc($result_total)['total'];
$total_paginas = ceil($total_productos / $productos_por_pagina);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

include('estilos/dashboard.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Productos</title>
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/estiloC.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            padding: 20px;
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #f44336;
            color: white;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #f44336;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ver Productos</h1>
        <div class="search-container">
            <form action="verProductos.php" method="GET">
                <input type="text" placeholder="Buscar por nombre, categoría o proveedor..." name="search" value="<?php echo htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $contador = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $contador . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombreProducto'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['descripcion'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['precio'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombreCategoria'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombreProveedor'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>
                            <button class='btn btn-primary' onclick='editarProducto(" . $row['idProducto'] . ")'>Editar</button>
                            <button class='btn btn-danger' onclick='confirmarEliminar(" . $row['idProducto'] . ")'>Eliminar</button>
                        </td>";
                        echo "</tr>";
                        $contador++;
                    }
                } else {
                    echo "<tr><td colspan='8'>No se encontraron productos.</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_paginas; $i++) {
                $active_class = $i == $pagina_actual ? 'active' : '';
                echo "<a href='verProductos.php?pagina=$i&search=$search_query' class='$active_class'>$i</a>";
            }
            ?>
        </div>
    </div>

    <!-- Modal para editar producto -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('editModal')">&times;</span>
            <h2>Editar Producto</h2>
            <form id="editForm" action="controllers/producto/editar_producto.php" method="POST">
                <input type="hidden" name="idProducto" id="idProducto">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="descripcion">Descripción:</label>
                <textarea name="descripcion" id="descripcion" required></textarea>
                <label for="precio">Precio:</label>
                <input type="number" name="precio" id="precio" step="0.01" required>
                <label for="stock">Stock:</label>
                <input type="number" name="stock" id="stock" required>
                <label for="idCategoria">Categoría:</label>
                <select name="idCategoria" id="idCategoria" required>
                    <!-- Aquí deberías cargar las categorías desde la base de datos -->
                    <?php
                    // Conectar a la base de datos y obtener las categorías
                    $conn = conectar();
                    $sql = "SELECT idCategoria, nombre FROM categorias";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['idCategoria']}'>{$row['nombre']}</option>";
                    }
                    mysqli_close($conn);
                    ?>
                </select>
                <label for="idProveedor">Proveedor:</label>
                <select name="idProveedor" id="idProveedor" required>
                    <!-- Aquí deberías cargar los proveedores desde la base de datos -->
                    <?php
                    // Conectar a la base de datos y obtener los proveedores
                    $conn = conectar();
                    $sql = "SELECT idProveedor, nombre FROM proveedores";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['idProveedor']}'>{$row['nombre']}</option>";
                    }
                    mysqli_close($conn);
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal para confirmar eliminación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('deleteModal')">&times;</span>
            <h2>Confirmar Eliminación</h2>
            <p>¿Está seguro de que desea eliminar este producto?</p>
            <form id="deleteForm" action="controllers/producto/eliminar_producto.php" method="POST">
                <input type="hidden" name="idProducto" id="deleteIdProducto">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" onclick="cerrarModal('deleteModal')">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function editarProducto(id) {
            fetch(`controllers/producto/obtener_producto.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('idProducto').value = data.idProducto;
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('descripcion').value = data.descripcion;
                        document.getElementById('precio').value = data.precio;
                        document.getElementById('stock').value = data.stock;
                        document.getElementById('idCategoria').value = data.idCategoria;
                        document.getElementById('idProveedor').value = data.idProveedor;
                        document.getElementById('editModal').style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function confirmarEliminar(id) {
            document.getElementById('deleteIdProducto').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

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
                if (mensaje === 'producto_actualizado') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Producto actualizado exitosamente.'
                    });
                } else if (mensaje === 'error_actualizacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al actualizar el producto. Inténtelo de nuevo.'
                    });
                } else if (mensaje === 'producto_eliminado') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Producto eliminado exitosamente.'
                    });
                } else if (mensaje === 'error_eliminacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al eliminar el producto. Inténtelo de nuevo.'
                    });
                }
            }
        });
    </script>
</body>

</html>
