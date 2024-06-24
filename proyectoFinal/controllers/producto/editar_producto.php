<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idProducto = $_POST['idProducto'];
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$idCategoria = $_POST['idCategoria'];
$idProveedor = $_POST['idProveedor'];

$sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, stock = ?, idCategoria = ?, idProveedor = ? WHERE idProducto = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssdiisi", $nombre, $descripcion, $precio, $stock, $idCategoria, $idProveedor, $idProducto);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../verProductos.php?mensaje=producto_actualizado");
} else {
    header("Location: ../../verProductos.php?error=error_actualizacion");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
