<?php
// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ejemplo de conexión a la base de datos (ajusta esto según tu configuración)
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error en la conexión a la base de datos: " . $conexion->connect_error);
    }

    // Obtener los valores del formulario y escaparlos para evitar inyección SQL
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $descripcion = $conexion->real_escape_string($_POST['descripcion']);
    $precio = $conexion->real_escape_string($_POST['precio']);
    $stock = $conexion->real_escape_string($_POST['stock']);
    $cantidad = $conexion->real_escape_string($_POST['cantidad']);
    $fechaCreacion = $conexion->real_escape_string($_POST['fechaCreacion']);
    $categoria = $conexion->real_escape_string($_POST['categoria']);
    $proveedor = $conexion->real_escape_string($_POST['proveedor']);

    // Insertar datos en la base de datos utilizando consulta preparada
    $query = $conexion->prepare("INSERT INTO productos (nombreProducto, descripcion, precio, stock, cantidad, fechaCreacion, categoria, proveedor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssisss", $nombre, $descripcion, $precio, $stock, $cantidad, $fechaCreacion, $categoria, $proveedor);

    if ($query->execute()) {
        $error_message = "<span style='color: green;'>Producto creado correctamente.</span>";
    } else {
        $error_message = "Datos insertados incorrectamente.";
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
?>
