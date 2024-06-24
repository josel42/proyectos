<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$stock = $_POST['stock'];
$idCategoria = $_POST['idCategoria'];
$idProveedor = $_POST['idProveedor'];

// Insertar el nuevo producto en la base de datos
$sql = "INSERT INTO productos (nombre, descripcion, precio, stock, idCategoria, idProveedor) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssdiis", $nombre, $descripcion, $precio, $stock, $idCategoria, $idProveedor);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../productos.php?mensaje=producto_agregado");
} else {
    header("Location: ../../productos.php?error=error_agregar");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
