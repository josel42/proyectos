<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: ../../index.html");
    exit();
}

include('../conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Obtener los datos del formulario
$idUsuario = $_SESSION['idUsuario'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$foto_perfil = null;

// Manejar la nueva contraseña si se proporciona
if (!empty($contraseña)) {
    $contraseña = password_hash($contraseña, PASSWORD_BCRYPT);
} else {
    // Obtener la contraseña actual
    $sql = "SELECT password FROM usuarios WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $idUsuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $contraseña_actual);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
    $contraseña = $contraseña_actual;
}

// Manejar la nueva foto de perfil si se proporciona
if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $foto_perfil = file_get_contents($_FILES['foto']['tmp_name']);
}

// Actualizar los datos del usuario
if ($foto_perfil) {
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ?, foto_perfil = ? WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $correo, $contraseña, $foto_perfil, $idUsuario);
} else {
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, password = ? WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre, $correo, $contraseña, $idUsuario);
}

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../perfil.php?mensaje=perfil_actualizado");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../perfil.php?mensaje=error_actualizacion");
    exit();
}
?>
