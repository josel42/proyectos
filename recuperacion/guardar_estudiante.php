<?php
include 'conexion.php';

$con = conectar();

$ci = $_POST['ci'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];

$sql = "INSERT INTO estudiante (CI, nombre, apellido, direccion, telefono) VALUES ('$ci', '$nombre', '$apellido', '$direccion', '$telefono')";

if ($con->query($sql) === TRUE) {
    header("Location: index.php?status=success");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}

$con->close();
?>
