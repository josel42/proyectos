<?php
include('controladores/navbar.php');
include('controladores/contUsuario.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- jQuery, DataTables JS, DataTables Bootstrap 4 JS, DataTables Buttons JS, JSZip, and DataTables Print JS -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <style>
        body {
            background-color: #ecf0f1;
            color: #2C3E50;
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

        /* Estilos para la tabla y botones */
        .table-responsive {
            margin-top: 20px;
        }

        #tablaUsuarios {
            width: 100%;
            margin-top: 20px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 10px;
            margin-top: 10px;
        }

        /* Estilo para el botón de exportar a Excel */
        .btn-excel {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
</head>

<body>

    <div class="content-wrapper">
        <div class="container">
            <h1>Usuarios</h1>
            <p>Aquí puedes agregar información sobre lo que hace una venta de papelería.</p>

            <div class="table-responsive">
                <table id="tablaUsuarios" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Email</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $contador = 1;

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>" . $contador . "</td>
                                <td>" . $row["usuario"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>
                                    <a href='verUsuario.php?id=" . $row["idUsuario"] . "' class='btn btn-success' class='fa fa-eye' >Visualizar</a>
                                    <a href='editarUsuario.php?id=" . $row["idUsuario"] . "' class='btn btn-primary'>Editar</a>
                                    <a href='eliminarUsuario.php?id=" . $row["idUsuario"] . "' class='btn btn-danger'>Eliminar</a>
                                </td>
                                </tr>";
                                $contador++;
                            }
                        } else {
                            echo "<tr><td colspan='4'>No hay usuarios</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <!-- Fin de la tabla de usuarios -->

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>

    <script>
        // Inicializar la tabla DataTables con botones
        // Inicializar la tabla DataTables con botones
        $(document).ready(function() {
            var table = $('#tablaUsuarios').DataTable({
                dom: 'Bfrtip',
                buttons: [{
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
            $('.btn-success').on('click', function() {
                table.button('excelHtml5').trigger();
            });

            $('.btn-danger').on('click', function() {
                table.button('pdfHtml5').trigger();
            });
        });
    </script>

</body>

</html>