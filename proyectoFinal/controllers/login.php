<?php
include('conexion.php');

// Conectar a la base de datos
$conn = conectar();

// Verificar conexión
if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

// Recibir los datos del formulario
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];

// Verificar si el correo está registrado
$sql = "SELECT idUsuario, nombre, password, rol FROM usuarios WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    // Obtener la contraseña cifrada, el nombre y el rol del usuario
    mysqli_stmt_bind_result($stmt, $idUsuario, $nombre, $hashed_password, $rol);
    mysqli_stmt_fetch($stmt);
    
    // Verificar la contraseña
    if (password_verify($contraseña, $hashed_password)) {
        // Iniciar sesión
        session_start();
        $_SESSION['idUsuario'] = $idUsuario;
        $_SESSION['correo'] = $correo;
        $_SESSION['nombre'] = $nombre;
        $_SESSION['rol'] = $rol;
        
        // Redirigir según el rol
        if ($rol == 'administrador') {
            header("Location: ../inicio.php");
        } else {
            header("Location: ../inicioU.php");
        }
        exit();
    } else {
        // Contraseña incorrecta
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        header("Location: ../index.html?error=contraseña_incorrecta");
        exit();
    }
} else {
    // Correo no registrado
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../index.html?error=correo_no_registrado");
    exit();
}
?>
