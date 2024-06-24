<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['imagen'])) {
    // Obtener los datos del formulario
    $titulo = $_POST["titulo"];
    $descripcion = $_POST["descripcion"];
    $imagen = $_FILES['imagen']['tmp_name'];

    // Conexión a la base de datos
    $conexion = new mysqli('localhost', 'root', '', 'imagenes');

    // Verificar la conexión
    if ($conexion->connect_error) {
        die('Error de conexión: ' . $conexion->connect_error);
    }

    // Leer la imagen como datos binarios
    $imagen_binaria = addslashes(file_get_contents($imagen));

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO imagenes (titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$imagen_binaria')";

    // Ejecutar la consulta
    if ($conexion->query($sql) === TRUE) {
        // Redireccionar a la misma página para actualizar la tabla
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error al guardar el contenido: " . $conexion->error;
    }

    // Cerrar la conexión
    $conexion->close();
}
?>
