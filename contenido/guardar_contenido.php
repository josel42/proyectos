<?php
$conexion = new mysqli('localhost', 'root', '', 'contenido');

if ($conexion->connect_error) {
    die('Error de conexión: ' . $conexion->connect_error);
}

$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];

$sql = "INSERT INTO contenido (titulo, descripcion) VALUES ('$titulo', '$descripcion')";

if ($conexion->query($sql) === TRUE) {
    echo 'Contenido guardado correctamente';
} else {
    echo 'Error al guardar el contenido: ' . $conexion->error;
}

$conexion->close();
?>
