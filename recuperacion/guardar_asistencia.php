<?php
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estudiante = $_POST['estudiante'];
    $asignatura = $_POST['asignatura'];
    $creditos = $_POST['creditos'];
    $atrasos = $_POST['atrasos'];
    $horaAtrasos = $_POST['horaAtrasos'];
    $faltas = $_POST['faltas'];
    $horaFaltas = $_POST['horaFaltas'];
    $horaTotal = $_POST['horaTotal'];
    $porcentaje_inasistencias = $_POST['porcentaje_inasistencias'];
    $porcentaje_asistencias = $_POST['porcentaje_asistencias'];
    $aprueba_asistencia = $_POST['aprueba_asistencia'] === 'Aprobado' ? 'Aprobado' : 'Reprobado';

    $con = conectar();

    $sql = "INSERT INTO asistencia (asignatura, creditos, atrasos, horaAtrasos, faltas, horaFaltas, horaTotal, porcentaje_inasistencias, porcentaje_asistencias, CI_estudiante, aprueba_asistencia)
            VALUES ('$asignatura', $creditos, $atrasos, $horaAtrasos, $faltas, $horaFaltas, $horaTotal, $porcentaje_inasistencias, $porcentaje_asistencias, $estudiante, '$aprueba_asistencia')";

    if ($con->query($sql) === TRUE) {
        header("Location: asistencias.php?status=success");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }

    $con->close();
}
?>
