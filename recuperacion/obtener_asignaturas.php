<?php
include('conexion.php');

$ci = $_GET['ci'];

$con = conectar();
$sql = "SELECT DISTINCT asignatura FROM asistencia WHERE CI_estudiante = '$ci'";
$result = $con->query($sql);

$asignaturas = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $asignaturas[] = $row['asignatura'];
    }
}

echo json_encode($asignaturas);

$con->close();
?>
