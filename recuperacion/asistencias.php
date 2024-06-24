<?php
include('navbar.html');
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencias</title>
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
    </style>
</head>

<body>
    <div class="container mt-3">
        <h2 class="mb-4 text-center">Registro de Asistencias</h2>
        <form id="asistenciaForm" action="guardar_asistencia.php" method="post">
            <div class="mb-3">
                <label for="estudiante" class="form-label">Estudiante:</label>
                <select class="form-select" id="estudiante" name="estudiante" required>
                    <?php
                    $con = conectar();
                    $sql = "SELECT CI, nombre, apellido FROM estudiante";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['CI']}'>{$row['CI']} - {$row['nombre']} {$row['apellido']}</option>";
                        }
                    } else {
                        echo "<option value=''>No hay estudiantes registrados</option>";
                    }
                    $con->close();
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="asignatura" class="form-label">Asignatura:</label>
                <input type="text" class="form-control" id="asignatura" name="asignatura" required>
            </div>
            <div class="mb-3">
                <label for="creditos" class="form-label">Créditos:</label>
                <input type="number" class="form-control" id="creditos" name="creditos" required>
            </div>
            <div class="mb-3">
                <label for="atrasos" class="form-label">Atrasos:</label>
                <input type="number" class="form-control" id="atrasos" name="atrasos" required oninput="calcularHoras()">
            </div>
            <div class="mb-3">
                <label for="horaAtrasos" class="form-label">Hora de Atrasos:</label>
                <input type="number" class="form-control" id="horaAtrasos" name="horaAtrasos" readonly>
            </div>
            <div class="mb-3">
                <label for="faltas" class="form-label">Faltas:</label>
                <input type="number" class="form-control" id="faltas" name="faltas" required oninput="calcularHoras()">
            </div>
            <div class="mb-3">
                <label for="horaFaltas" class="form-label">Hora de Faltas:</label>
                <input type="number" class="form-control" id="horaFaltas" name="horaFaltas" readonly>
            </div>
            <div class="mb-3">
                <label for="horaTotal" class="form-label">Hora Total:</label>
                <input type="number" class="form-control" id="horaTotal" name="horaTotal" readonly>
            </div>
            <input type="hidden" id="porcentaje_inasistencias" name="porcentaje_inasistencias">
            <input type="hidden" id="porcentaje_asistencias" name="porcentaje_asistencias">
            <input type="hidden" id="aprueba_asistencia" name="aprueba_asistencia">
            <button type="submit" class="btn btn-primary w-100">
                <i class="fas fa-save"></i> Guardar Asistencia
            </button>
        </form>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
            <script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'La asistencia ha sido guardada correctamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <h2 class="mt-5 mb-4 text-center">Lista de Asistencias</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">CI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Créditos</th>
                    <th scope="col">Atrasos</th>
                    <th scope="col">Hora de Atrasos</th>
                    <th scope="col">Faltas</th>
                    <th scope="col">Hora de Faltas</th>
                    <th scope="col">Hora Total</th>
                    <th scope="col">Porcentaje Inasistencias</th>
                    <th scope="col">Porcentaje Asistencias</th>
                    <th scope="col">Aprueba Asistencia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = conectar();
                $sql = "SELECT estudiante.CI, estudiante.nombre, estudiante.apellido, asistencia.asignatura, asistencia.creditos, asistencia.atrasos, asistencia.horaAtrasos, asistencia.faltas, asistencia.horaFaltas, asistencia.horaTotal, asistencia.porcentaje_inasistencias, asistencia.porcentaje_asistencias, asistencia.aprueba_asistencia 
                        FROM asistencia 
                        INNER JOIN estudiante ON asistencia.CI_estudiante = estudiante.CI";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["CI"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["apellido"]; ?></td>
                            <td><?php echo $row["asignatura"]; ?></td>
                            <td><?php echo $row["creditos"]; ?></td>
                            <td><?php echo $row["atrasos"]; ?></td>
                            <td><?php echo $row["horaAtrasos"] . 'h'; ?></td>
                            <td><?php echo $row["faltas"]; ?></td>
                            <td><?php echo $row["horaFaltas"] . 'h'; ?></td>
                            <td><?php echo $row["horaTotal"] . 'h'; ?></td>
                            <td><?php echo $row["porcentaje_inasistencias"] . '%'; ?></td>
                            <td><?php echo $row["porcentaje_asistencias"] . '%'; ?></td>
                            <td><?php echo $row["aprueba_asistencia"]; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan='13'>No hay asistencias registradas</td>
                    </tr>
                <?php }
                $con->close();
                ?>
            </tbody>
        </table>
    </div>
    <script>
        function calcularHoras() {
            let atrasos = parseFloat(document.getElementById('atrasos').value) || 0;
            let faltas = parseFloat(document.getElementById('faltas').value) || 0;

            let horaAtrasos = atrasos * 1;
            let horaFaltas = faltas * 2;
            let horaTotal = horaAtrasos + horaFaltas;

            document.getElementById('horaAtrasos').value = horaAtrasos;
            document.getElementById('horaFaltas').value = horaFaltas;
            document.getElementById('horaTotal').value = horaTotal;
        }

        document.getElementById('asistenciaForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let creditos = parseFloat(document.getElementById('creditos').value);
            let totalHoras = creditos * 20;
            let horaTotal = parseFloat(document.getElementById('horaTotal').value);

            let porcentajeInasistencias = (horaTotal / totalHoras) * 100;
            let porcentajeAsistencias = 100 - porcentajeInasistencias;
            let apruebaAsistencia = porcentajeAsistencias >= 75 ? 'Aprobado' : 'Reprobado';

            document.getElementById('porcentaje_inasistencias').value = porcentajeInasistencias.toFixed(2);
            document.getElementById('porcentaje_asistencias').value = porcentajeAsistencias.toFixed(2);
            document.getElementById('aprueba_asistencia').value = apruebaAsistencia;

            this.submit();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>