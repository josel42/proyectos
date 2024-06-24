<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$idUsuario = $_POST['idUsuario'];
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$foto_perfil = null;

if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == 0) {
    $foto_perfil = file_get_contents($_FILES['foto_perfil']['tmp_name']);
}

if ($foto_perfil) {
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ?, foto_perfil = ? WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssi", $nombre, $email, $rol, $foto_perfil, $idUsuario);
} else {
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, rol = ? WHERE idUsuario = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $nombre, $email, $rol, $idUsuario);
}

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../ver_usuarios.php?mensaje=usuario_actualizado");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../ver_usuarios.php?mensaje=error_actualizacion");
    exit();
}
?>
