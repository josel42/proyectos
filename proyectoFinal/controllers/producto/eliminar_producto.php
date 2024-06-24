<?php
include('../conexion.php');

$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

$idProducto = $_POST['idProducto'];

// Verificar relaciones en otras tablas
$relaciones = [];

// Verificación de relación con otras tablas
// Aquí se agregarán las verificaciones de relaciones específicas, si es necesario

if (!empty($relaciones)) {
    // Redirigir a noborrarProducto.php con las relaciones que impiden la eliminación
    $relaciones_param = implode(',', $relaciones);
    header("Location: ../../noborrarProducto.php?idProducto=$idProducto&relaciones=$relaciones_param");
    exit();
}

// Si no hay relaciones, proceder a eliminar el producto
$sql = "DELETE FROM productos WHERE idProducto = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProducto);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verProductos.php?mensaje=producto_eliminado");
    exit();
} else {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("Location: ../../verProductos.php?mensaje=error_eliminacion");
    exit();
}
?>
