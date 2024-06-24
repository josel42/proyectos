<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$direccion = $_POST['direccion'];

// Insertar el nuevo proveedor en la base de datos
$sql = "INSERT INTO proveedores (nombre, telefono, email, direccion) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $nombre, $telefono, $email, $direccion);

if (mysqli_stmt_execute($stmt)) {
    header("Location: ../../proveedores.php?mensaje=proveedor_agregado");
} else {
    header("Location: ../../proveedores.php?error=error_agregar");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
