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

$idCategoria = $_GET['idCategoria'];
$relaciones = explode(',', $_GET['relaciones']);

include('estilos/dashboard.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categoría no se puede eliminar</title>
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
            background-color: #4CAF50;
            color: white;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>No se puede eliminar la categoría</h1>
        <p>La categoría no puede ser eliminada debido a relaciones existentes en las siguientes tablas:</p>
        <table>
            <thead>
                <tr>
                    <th>Tabla</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($relaciones as $relacion) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($relacion, ENT_QUOTES, 'UTF-8') . "</td>";
                    echo "<td>";

                    // Mostrar detalles de la relación
                    if ($relacion == 'productos') {
                        $sql_detalle = "SELECT * FROM productos WHERE idCategoria = ?";
                        $stmt_detalle = mysqli_prepare($conn, $sql_detalle);
                        mysqli_stmt_bind_param($stmt_detalle, "i", $idCategoria);
                        mysqli_stmt_execute($stmt_detalle);
                        $result_detalle = mysqli_stmt_get_result($stmt_detalle);

                        while ($row_detalle = mysqli_fetch_assoc($result_detalle)) {
                            echo "ID Producto: " . $row_detalle['idProducto'] . "<br>";
                            echo "Nombre: " . $row_detalle['nombre'] . "<br>";
                            echo "Descripción: " . $row_detalle['descripcion'] . "<br>";
                            echo "Precio: " . $row_detalle['precio'] . "<br>";
                            echo "Stock: " . $row_detalle['stock'] . "<br>";
                            echo "<hr>";
                        }

                        mysqli_stmt_close($stmt_detalle);
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="window.location.href='verCategorias.php'">Volver</button>
    </div>
</body>

</html>
