<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idProveedor = $_POST['idProveedor'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

$sql = "UPDATE proveedores SET nombre = ?, telefono = ?, email = ?, direccion = ? WHERE idProveedor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $telefono, $email, $direccion, $idProveedor);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../verProveedores.php?mensaje=proveedor_actualizado");
} else {
    header("Location: ../../verProveedores.php?error=error_actualizacion");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
