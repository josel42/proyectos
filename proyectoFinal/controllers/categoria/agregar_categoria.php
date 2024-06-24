<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

// Insertar la nueva categoría en la base de datos
$sql = "INSERT INTO categorias (nombre, descripcion) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ss", $nombre, $descripcion);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../categorias.php?mensaje=categoria_agregada");
} else {
    header("Location: ../../categorias.php?error=error_agregar");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
