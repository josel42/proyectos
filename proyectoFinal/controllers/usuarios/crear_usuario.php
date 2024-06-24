<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);
$rol = $_POST['rol'];

$sql = "SELECT idUsuario FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../crear_usuario.php?mensaje=correo_existente");
    exit();
}

if (isset($_FILES['foto']['tmp_name']) && $_FILES['foto']['tmp_name'] != '') {
    $foto = $_FILES['foto']['tmp_name'];
    $fotoContenido = file_get_contents($foto);
} else {
    header("Location: ../../crear_usuario.php?mensaje=error_foto");
    exit();
}

$sql = "INSERT INTO usuarios (nombre, email, password, foto_perfil, rol) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "sssss", $nombre, $correo, $contraseña, $fotoContenido, $rol);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../crear_usuario.php?mensaje=cuenta_creada");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../crear_usuario.php?mensaje=error_creacion");
    exit();
}
?>
