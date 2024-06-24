<?php
include('conexion.php');

$con = conectar();

$ci_estudiante = $_POST['estudiante'];
$asignatura = $_POST['asignatura'];
$trabajos_autonomos = $_POST['trabajos_autonomos'];
$trabajos_colaborativos = $_POST['trabajos_colaborativos'];
$guias_practicas = $_POST['guias_practicas'];
$evaluacion_parcial = $_POST['evaluacion_parcial'];
$evaluacion_final = $_POST['evaluacion_final'];
$proyecto_final = $_POST['proyecto_final'];
$total_puntos = $_POST['total_puntos'];
$aprueba = $_POST['aprueba'];

$sql = "INSERT INTO notas (trabajos_autonomos, trabajos_colaborativos, guias_practicas, evaluacion_parcial, evaluacion_final, proyecto_final, CI_estudiante, asignatura, total_puntos, aprueba) 
        VALUES ('$trabajos_autonomos', '$trabajos_colaborativos', '$guias_practicas', '$evaluacion_parcial', '$evaluacion_final', '$proyecto_final', '$ci_estudiante', '$asignatura', '$total_puntos', '$aprueba')";

if ($con->query($sql) === TRUE) {
    header("Location: registro_total.php?status=success");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
