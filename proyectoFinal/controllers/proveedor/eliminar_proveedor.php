<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$idProveedor = $_POST['idProveedor'];

// Verificar relaciones en otras tablas
$relaciones = [];

// Verificación de relación con la tabla `productos`
$sql_check = "SELECT COUNT(*) as total FROM productos WHERE idProveedor = ?";
$stmt_check = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt_check, "i", $idProveedor);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['total'] > 0) {
    $relaciones[] = 'productos';
}

mysqli_stmt_close($stmt_check);

if (!empty($relaciones)) {
    // Redirigir a noborrarProveedor.php con las relaciones que impiden la eliminación
    $relaciones_param = implode(',', $relaciones);
    header("Location: ../../noborrarProveedor.php?idProveedor=$idProveedor&relaciones=$relaciones_param");
    exit();
}

// Si no hay relaciones, proceder a eliminar el proveedor
$sql = "DELETE FROM proveedores WHERE idProveedor = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProveedor);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verProveedores.php?mensaje=proveedor_eliminado");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verProveedores.php?mensaje=error_eliminacion");
    exit();
}
?>
