<?php
// Verificar si se ha enviado el ID del contenido a eliminar
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    // Obtener el ID del contenido a eliminar
    $id = $_GET["id"];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'contenido');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }

    // Preparar la consulta SQL para eliminar el contenido
    $sql = "DELETE FROM contenido WHERE id = $id";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Redireccionar a la página principal
        header("Location: index.php");
        exit();
    } else {
        echo "Error al eliminar el contenido: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
