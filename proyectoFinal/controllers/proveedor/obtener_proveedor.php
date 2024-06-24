<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

$idProveedor = $_GET['id'];

$sql = "SELECT idProveedor, nombre, telefono, email, direccion FROM proveedores WHERE idProveedor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProveedor);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Proveedor no encontrado']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
