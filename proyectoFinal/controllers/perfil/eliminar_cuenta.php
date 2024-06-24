<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}

include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Obtener el id del usuario
$idUsuario = $_SESSION['idUsuario'];

// Eliminar el usuario de la base de datos
$sql = "DELETE FROM usuarios WHERE idUsuario = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    session_destroy();
    header("Location: ../../index.html?mensaje=cuenta_eliminada");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../perfil.php?mensaje=error_eliminacion");
    exit();
}
?>
