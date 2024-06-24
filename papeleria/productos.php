<?php
include('controladores/navbar.php');
include('controladores/contProducto.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
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
            color: #FFA200;
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

        .dataTables_wrapper {
            padding: 20px;
        }
    </style>
</head>

<body>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Puedes agregar tu contenido principal aquí -->
        <div class="container">
            <h1>Productos</h1>
            <!-- Tabla de Productos -->
            <table id="productosTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                        <!-- Agrega más columnas según tus necesidades -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Obtener los productos desde la base de datos
                    $productos = getProductos();

                    foreach ($productos as $producto) {
                        echo "<tr>";
                        echo "<td>{$producto['idProducto']}</td>";
                        echo "<td>{$producto['nombreProducto']}</td>";
                        echo "<td>{$producto['descripcion']}</td>";
                        echo "<td>{$producto['precio']}</td>";
                        echo "<td>{$producto['stock']}</td>";
                        echo "<td>{$producto['cantidad']}</td>";
                        echo "<td>";
                        echo "<a href='verProducto.php?id={$producto['idProducto']}' class='btn btn-info btn-sm'><i class='fas fa-eye'></i> Visualizar</a> ";
                        echo "<a href='editarProducto.php?id={$producto['idProducto']}' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Editar</a> ";
                        echo "<a href='eliminarProducto.php?id={$producto['idProducto']}' class='btn btn-danger btn-sm'><i class='fas fa-trash'></i> Eliminar</a>";
                        echo "</td>";
                        // Agrega más celdas según tus necesidades
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <!-- Fin de la Tabla de Productos -->
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

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script>
        // Inicializar la tabla DataTables con botones
        $(document).ready(function () {
            var table = $('#productosTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        className: 'btn-success',
                        text: '<i class="fas fa-file-excel"></i> Exportar a Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        className: 'btn-danger',
                        text: '<i class="fas fa-file-pdf"></i> Exportar a PDF'
                    }
                ]
            });

            // Agregar eventos de clic para los botones de exportar
            $('#exportarExcel').on('click', function () {
                table.button('excelHtml5').trigger();
            });

            $('#exportarPDF').on('click', function () {
                table.button('pdfHtml5').trigger();
            });
        });
    </script>
</body>

</html>

