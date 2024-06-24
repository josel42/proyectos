<?php
include('navbar.html');
include('conexion.php');
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Notas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-a8jRxnAyNHKPAkS8EeBxZk5t5ZISdLezH7T4t6/KNcGBoBc6Glws1czW5DN0y+e1kMwdo/wBZZJ8YsHQpLbOhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
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

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .form-label {
            font-weight: bold;
        }

        .mb-3 {
            margin-bottom: 1.5rem;
        }

        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
    </style>
    <script>
        function calcularNotas() {
            var trabajosAutonomos = parseFloat(document.getElementById("trabajos_autonomos").value) || 0;
            var trabajosColaborativos = parseFloat(document.getElementById("trabajos_colaborativos").value) || 0;
            var guiasPracticas = parseFloat(document.getElementById("guias_practicas").value) || 0;
            var evaluacionesParciales = parseFloat(document.getElementById("evaluacion_parcial").value) || 0;
            var evaluacionFinal = parseFloat(document.getElementById("evaluacion_final").value) || 0;
            var proyectoFinal = parseFloat(document.getElementById("proyecto_final").value) || 0;

            var trabajosAutonomos_puntos = (trabajosAutonomos / 10) * 2;
            var trabajosColaborativos_puntos = (trabajosColaborativos / 10) * 2;
            var guiasPracticas_puntos = (guiasPracticas / 10) * 3;
            var evaluacionesParciales_puntos = (evaluacionesParciales / 10) * 1;
            var evaluacionFinal_puntos = (evaluacionFinal / 10) * 1;
            var proyectoFinal_puntos = (proyectoFinal / 10) * 1;

            var total_puntos = trabajosAutonomos_puntos + trabajosColaborativos_puntos + guiasPracticas_puntos + evaluacionesParciales_puntos + evaluacionFinal_puntos + proyectoFinal_puntos;

            var aprueba = total_puntos >= 7 ? 'Aprobado' : (total_puntos >= 5 ? 'Supletorio' : 'Reprobado');

            document.getElementById('total_puntos').value = total_puntos.toFixed(2);
            document.getElementById('aprueba').value = aprueba;
        }
    </script>
</head>

<body>
    <div class="container mt-3">
        <h2 class="mb-4 text-center">Registro de Notas</h2>
        <form id="notasForm" action="guardar_notas.php" method="post" onsubmit="calcularNotas()">
            <div class="mb-3">
                <label for="estudiante" class="form-label">Estudiante:</label>
                <select class="form-select" id="estudiante" name="estudiante" required>
                    <option value="">Seleccione un estudiante</option>
                    <?php
                    $con = conectar();
                    $sql = "SELECT estudiante.CI, estudiante.nombre, estudiante.apellido FROM estudiante";
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
                <select class="form-select" id="asignatura" name="asignatura" required>
                    <option value="">Seleccione una asignatura</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="trabajos_autonomos" class="form-label">Trabajos Autónomos:</label>
                <input type="number" step="0.1" class="form-control" id="trabajos_autonomos" name="trabajos_autonomos" required>
            </div>
            <div class="mb-3">
                <label for="trabajos_colaborativos" class="form-label">Trabajos Colaborativos:</label>
                <input type="number" step="0.1" class="form-control" id="trabajos_colaborativos" name="trabajos_colaborativos" required>
            </div>
            <div class="mb-3">
                <label for="guias_practicas" class="form-label">Guías Prácticas:</label>
                <input type="number" step="0.1" class="form-control" id="guias_practicas" name="guias_practicas" required>
            </div>
            <div class="mb-3">
                <label for="evaluacion_parcial" class="form-label">Evaluación Parcial:</label>
                <input type="number" step="0.1" class="form-control" id="evaluacion_parcial" name="evaluacion_parcial" required>
            </div>
            <div class="mb-3">
                <label for="evaluacion_final" class="form-label">Evaluación Final:</label>
                <input type="number" step="0.1" class="form-control" id="evaluacion_final" name="evaluacion_final" required>
            </div>
            <div class="mb-3">
                <label for="proyecto_final" class="form-label">Proyecto Final:</label>
                <input type="number" step="0.1" class="form-control" id="proyecto_final" name="proyecto_final" required>
            </div>
            <input type="hidden" id="total_puntos" name="total_puntos">
            <input type="hidden" id="aprueba" name="aprueba">
            <button type="submit" class="btn btn-primary w-100"><i class="fas fa-save"></i> Guardar Notas</button>
        </form>

        <?php if (isset($_GET['status']) && $_GET['status'] == 'success') : ?>
            <script>
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'Las notas han sido guardadas correctamente.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>
        <?php endif; ?>

        <h2 class="mt-5 mb-4">Lista de Notas</h2>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">CI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Asignatura</th>
                    <th scope="col">Créditos</th>
                    <th scope="col">Porcentaje de Asistencias</th>
                    <th scope="col">Asistencia Final</th>
                    <th scope="col">Trabajos Autónomos</th>
                    <th scope="col">Trabajos Colaborativos</th>
                    <th scope="col">Guías Prácticas</th>
                    <th scope="col">Evaluación Parcial</th>
                    <th scope="col">Evaluación Final</th>
                    <th scope="col">Proyecto Final</th>
                    <th scope="col">Promedio Final</th>
                    <th scope="col">Nota Final</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $con = conectar();
                $sql = "SELECT estudiante.CI, estudiante.nombre, estudiante.apellido, asistencia.asignatura,
                        asistencia.creditos, asistencia.porcentaje_asistencias, aprueba_asistencia, 
                        notas.trabajos_autonomos, notas.trabajos_colaborativos, notas.guias_practicas, 
                        notas.evaluacion_parcial, notas.evaluacion_final, notas.proyecto_final, 
                        notas.total_puntos, notas.aprueba 
                        FROM notas 
                        INNER JOIN estudiante ON notas.CI_estudiante = estudiante.CI 
                        INNER JOIN asistencia ON notas.CI_estudiante = asistencia.CI_estudiante 
                        AND notas.asignatura = asistencia.asignatura";
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row["CI"]; ?></td>
                            <td><?php echo $row["nombre"]; ?></td>
                            <td><?php echo $row["apellido"]; ?></td>
                            <td><?php echo $row["asignatura"]; ?></td>
                            <td><?php echo $row["creditos"]; ?></td>
                            <td><?php echo $row["porcentaje_asistencias"] . '%'; ?></td>
                            <td><?php echo $row["aprueba_asistencia"]; ?></td>
                            <td><?php echo ($row["trabajos_autonomos"] / 10) * 2; ?></td>
                            <td><?php echo ($row["trabajos_colaborativos"] / 10) * 2; ?></td>
                            <td><?php echo ($row["guias_practicas"] / 10) * 3; ?></td>
                            <td><?php echo ($row["evaluacion_parcial"] / 10) * 1; ?></td>
                            <td><?php echo ($row["evaluacion_final"] / 10) * 1; ?></td>
                            <td><?php echo ($row["proyecto_final"] / 10) * 1; ?></td>
                            <td><?php echo $row["total_puntos"]; ?></td>
                            <td><?php echo $row["aprueba"]; ?></td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan='15'>No hay notas registradas</td>
                    </tr>
                <?php }
                $con->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('estudiante').addEventListener('change', function() {
            var estudianteCI = this.value;
            if (estudianteCI) {
                fetch('obtener_asignaturas.php?ci=' + estudianteCI)
                    .then(response => response.json())
                    .then(data => {
                        var asignaturaSelect = document.getElementById('asignatura');
                        asignaturaSelect.innerHTML = '<option value="">Seleccione una asignatura</option>';
                        data.forEach(asignatura => {
                            var option = document.createElement('option');
                            option.value = asignatura;
                            option.textContent = asignatura;
                            asignaturaSelect.appendChild(option);
                        });
                    });
            } else {
                document.getElementById('asignatura').innerHTML = '<option value="">Seleccione una asignatura</option>';
            }
        });

        const inputs = document.querySelectorAll('#notasForm input[type="number"]');
        inputs.forEach(input => {
            input.addEventListener('input', calcularNotas);
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
