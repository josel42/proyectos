<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$idCategoria = $_POST['idCategoria'];

// Verificar relaciones en otras tablas
$relaciones = [];

// Verificación de relación con la tabla `productos`
$sql_check = "SELECT COUNT(*) as total FROM productos WHERE idCategoria = ?";
$stmt_check = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt_check, "i", $idCategoria);
mysqli_stmt_execute($stmt_check);
$result_check = mysqli_stmt_get_result($stmt_check);
$row_check = mysqli_fetch_assoc($result_check);

if ($row_check['total'] > 0) {
    $relaciones[] = 'productos';
}

mysqli_stmt_close($stmt_check);

if (!empty($relaciones)) {
    // Redirigir a noborrarCategoria.php con las relaciones que impiden la eliminación
    $relaciones_param = implode(',', $relaciones);
    header("Location: ../../noborrarCategoria.php?idCategoria=$idCategoria&relaciones=$relaciones_param");
    exit();
}

// Si no hay relaciones, proceder a eliminar la categoría
$sql = "DELETE FROM categorias WHERE idCategoria = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idCategoria);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verCategorias.php?mensaje=categoria_eliminada");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verCategorias.php?mensaje=error_eliminacion");
    exit();
}
?>
