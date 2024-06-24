<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idCategoria = $_GET['id'];

$sql = "SELECT idCategoria, nombre, descripcion FROM categorias WHERE idCategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idCategoria);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Categoría no encontrada']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
