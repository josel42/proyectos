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

$idProducto = $_GET['idProducto'];
$relaciones = explode(',', $_GET['relaciones']);

include('estilos/dashboard.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto no se puede eliminar</title>
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
        <h1>No se puede eliminar el producto</h1>
        <p>El producto no puede ser eliminado debido a relaciones existentes en las siguientes tablas:</p>
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
                    // Aquí se agregan los detalles de las relaciones específicas
                    switch($relacion) {
                        case 'ordenes':
                            // Ejemplo de mostrar detalles específicos de la relación con órdenes
                            $sql_ordenes = "SELECT idOrden, fecha, cantidad FROM ordenes WHERE idProducto = ?";
                            $stmt_ordenes = mysqli_prepare($conn, $sql_ordenes);
                            mysqli_stmt_bind_param($stmt_ordenes, "i", $idProducto);
                            mysqli_stmt_execute($stmt_ordenes);
                            $result_ordenes = mysqli_stmt_get_result($stmt_ordenes);
                            if (mysqli_num_rows($result_ordenes) > 0) {
                                while ($row_ordenes = mysqli_fetch_assoc($result_ordenes)) {
                                    echo "Orden ID: " . htmlspecialchars($row_ordenes['idOrden'], ENT_QUOTES, 'UTF-8') . ", Fecha: " . htmlspecialchars($row_ordenes['fecha'], ENT_QUOTES, 'UTF-8') . ", Cantidad: " . htmlspecialchars($row_ordenes['cantidad'], ENT_QUOTES, 'UTF-8') . "<br>";
                                }
                            }
                            mysqli_stmt_close($stmt_ordenes);
                            break;

                        // Aquí puedes agregar más casos para otras relaciones
                    }

                    echo "</td>";
                    echo "</tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="window.location.href='verProductos.php'">Volver</button>
    </div>
</body>

</html>
