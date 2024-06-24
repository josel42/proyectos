<?php
include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Verificar conexión
if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

// Obtener el ID del usuario
$idUsuario = $_GET['id'];

// Recuperar los datos del usuario
$sql = "SELECT idUsuario, nombre, email, rol FROM usuarios WHERE idUsuario = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode($row);
} else {
    echo json_encode(['error' => 'Usuario no encontrado']);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
