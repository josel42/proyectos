<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$idUsuario = $_GET['idUsuario'];

// Verificar relaciones en otras tablas
$relaciones = [];

// Ejemplo de verificación de relación con la tabla `movimientos_inventario`
$sql_check = "SELECT COUNT(*) as total FROM movimientos_inventario WHERE idUsuario = ?";
$stmt_check = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt_check, "i", $idUsuario);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['total'] > 0) {
    $relaciones[] = 'movimientos_inventario';
}

mysqli_stmt_close($stmt_check);

if (!empty($relaciones)) {
    // Redirigir a noborrarUsuario.php con las relaciones que impiden la eliminación
    $relaciones_param = implode(',', $relaciones);
    header("Location: ../../noborrarUsuario.php?idUsuario=$idUsuario&relaciones=$relaciones_param");
    exit();
}

// Si no hay relaciones, proceder a eliminar el usuario
$sql = "DELETE FROM usuarios WHERE idUsuario = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idUsuario);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../ver_usuarios.php?mensaje=usuario_eliminado");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../ver_usuarios.php?mensaje=error_eliminacion");
    exit();
}
?>
