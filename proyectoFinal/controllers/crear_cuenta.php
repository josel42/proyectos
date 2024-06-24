<?php
include('conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$confirmarContraseña = $_POST['confirmar_contraseña'];

// Verificar si las contraseñas coinciden
if ($contraseña !== $confirmarContraseña) {
    header("Location: ../index.html?error=contraseñas_no_coinciden");
    exit();
}

$contraseñaHashed = password_hash($contraseña, PASSWORD_BCRYPT);

$sql = "SELECT idUsuario FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.html?error=correo_existente");
    exit();
}

$foto = $_FILES['foto']['tmp_name'];
$fotoContenido = file_get_contents($foto);

$sql = "INSERT INTO usuarios (nombre, email, password, foto_perfil, rol) VALUES (?, ?, ?, ?, 'usuario')";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "ssss", $nombre, $correo, $contraseñaHashed, $fotoContenido);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.html?success=cuenta_creada");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.html?error=error_creacion");
    exit();
}
?>
