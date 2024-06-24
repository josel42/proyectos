<?php
include('controllers/conexion.php');
include("estilo/navbar.html");
include('controllers/insertCli.php');
?>

<!DOCTYPE html>
<html lang="es-ES">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes Registrados</title>
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
    <div class="container">
        <center>
            <h1 class="mt-5">Registrar Cliente</h1>
        </center>
        <form class="mt-3" method="post" enctype="multipart/form-data">
            <div class="mb-3 row">
                <label class="form-label col-sm-3 fw-bold">Nombre:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="nombreCli" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label col-sm-3 fw-bold">Apellido:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="apellidoCli" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label col-sm-3 fw-bold">Dirección:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="direccionCli" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label col-sm-3 fw-bold">Teléfono:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="telefonoCli" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label class="form-label col-sm-3 fw-bold">Foto de Perfil:</label>
                <div class="col-sm-4">
                    <input type="file" class="form-control" name="imagenPerfil">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Registrar Cliente</button>
        </form>
        <h1 class="mt-5">Clientes Registrados</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Dirección</th>
                    <th>Teléfono</th>
                    <th>Imagen de Perfil</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $contador = 1;
                // Crear una nueva conexión a la base de datos para obtener los datos de los clientes
                $conexion_mostrar = new mysqli($host, $usuario, $contrasena, $base_datos);

                // Verificar la conexión
                if ($conexion_mostrar->connect_error) {
                    die("Error al conectar con la base de datos: " . $conexion_mostrar->connect_error);
                }

                // Consulta para obtener los datos de los clientes
                $consulta = "SELECT idCliente, nombreCli, apellidoCli, direccionCli, telefonoCli, MAX(imagenPerfil) as imagenPerfil FROM clientes GROUP BY idCliente";
                $resultado = $conexion_mostrar->query($consulta);

                if ($resultado->num_rows > 0) {
                    // Mostrar cada fila de resultados
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $contador++ . "</td>";
                        echo "<td>" . $fila['nombreCli'] . "</td>";
                        echo "<td>" . $fila['apellidoCli'] . "</td>";
                        echo "<td>" . $fila['direccionCli'] . "</td>";
                        echo "<td>" . $fila['telefonoCli'] . "</td>";
                        // Mostrar la imagen de perfil si está disponible
                        if ($fila['imagenPerfil'] != NULL) {
                            echo '<td><img src="data:image/jpeg;base64,' . base64_encode($fila['imagenPerfil']) . '"></td>';
                        } else {
                            echo "<td>No hay imagen</td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron clientes registrados.</td></tr>";
                }

                // Cerrar la conexión
                $conexion_mostrar->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Pie de página -->
    <div class="pie-pagina">
        <p>© 2024 Kiosko Virtual - Todos los derechos reservados.</p>
    </div>
</body>

</html>