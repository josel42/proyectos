<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idProducto = $_GET['id'];

$sql = "SELECT idProducto, nombre, descripcion, precio, stock, idCategoria, idProveedor FROM productos WHERE idProducto = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProducto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Producto no encontrado']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
