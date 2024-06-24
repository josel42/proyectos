<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idCategoria = $_POST['idCategoria'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];

$sql = "UPDATE categorias SET nombre = ?, descripcion = ? WHERE idCategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssi", $nombre, $descripcion, $idCategoria);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../verCategorias.php?mensaje=categoria_actualizada");
} else {
    header("Location: ../../verCategorias.php?error=error_actualizacion");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
