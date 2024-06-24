<?php
include('guardar_contenido.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guardar Imagenes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="stylesheet" href="estilos.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <div class="container">
            <h1>Guardar Imagenes</h1>
            <form id="formulario" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" required>
                <button type="submit">Guardar</button>
            </form>
        </div>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Mi Aplicación</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>Contenidos</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Lista de Contenidos</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <table id="tabla-contenidos" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Imagen</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Conexión a la base de datos
                                    $conexion = new mysqli('localhost', 'root', '', 'imagenes');

                                    // Verificar la conexión
                                    if ($conexion->connect_error) {
                                        die('Error de conexión: ' . $conexion->connect_error);
                                    }

                                    // Consulta SQL para obtener todos los contenidos
                                    $sql = "SELECT * FROM imagenes";
                                    $result = $conexion->query($sql);

                                    // Verificar si hay resultados
                                    if ($result->num_rows > 0) {
                                        // Iterar sobre los resultados y mostrar cada fila en la tabla
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["titulo"] . "</td>";
                                            echo "<td>" . $row["descripcion"] . "</td>";
                                            echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['imagen']) . "' width='100' /></td>";
                                            echo "<td><a href='eliminar.php?id=" . $row["id"] . "' class='btn btn-danger' onclick='return confirmarEliminacion()'>Eliminar</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>No hay contenidos guardados</td></tr>";
                                    }

                                    // Cerrar la conexión
                                    $conexion->close();
                                    ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Versión</b> 1.0
            </div>
            <strong>&copy; 2024 Mi Aplicación</strong> Todos los derechos reservados.
        </footer>
        <!-- /.footer -->
    </div>
    <!-- ./wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de querer eliminar este contenido?");
        }
    </script>
</body>

</html>