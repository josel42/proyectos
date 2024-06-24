<?php
include('navbar.html');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Ingreso de Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        h2 {
            color: #343a40;
        }

        .table {
            margin-top: 20px;
        }

        .table th,
        .table td {
            text-align: center;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            transition: background-color 0.3s, border-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }

        .form-control-sm {
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="container mt-3">
        <h2 class="mb-4 text-center">Registro de Estudiantes</h2>
        <form action="guardar_estudiante.php" method="post">
            <div class="mb-3">
                <label for="ci" class="form-label">CI:</label>
                <input type="number" class="form-control form-control-sm" id="ci" name="ci" required>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido:</label>
                <input type="text" class="form-control form-control-sm" id="apellido" name="apellido" required>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono:</label>
                <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save"></i> Guardar Estudiante
            </button>
        </form>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
            <script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'El estudiante ha sido guardado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <h2 class="mt-5 mb-4 text-center">Lista de Estudiantes</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">CI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexion.php';
                $con = conectar();
                $sql = "SELECT * FROM estudiante";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["CI"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["apellido"]; ?></td>
                            <td><?php echo $row["direccion"]; ?></td>
                            <td><?php echo $row["telefono"]; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan='5'>No hay estudiantes registrados</td>
                    </tr>
                <?php }
                $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>