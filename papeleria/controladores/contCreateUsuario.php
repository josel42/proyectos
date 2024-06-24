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
    $apellido = $conexion->real_escape_string($_POST['apellido']);
    $usuario = $conexion->real_escape_string($_POST['usuario']);
    $contra = $conexion->real_escape_string($_POST['contra']);
    $edad = $conexion->real_escape_string($_POST['edad']);
    $email = $conexion->real_escape_string($_POST['email']);

    // Insertar datos en la base de datos utilizando consulta preparada
    $query = $conexion->prepare("INSERT INTO usuarios (nombreUsuario, apellido, usuario, contra, edad, email) VALUES (?, ?, ?, ?, ?, ?)");
    $query->bind_param("ssssis", $nombre, $apellido, $usuario, $contra, $edad, $email);

    if ($query->execute()) {
        $error_message = "<span style='color: green;'>Usuario creado correctamente.</span>";
    } else {
        echo "Error al insertar datos en la base de datos: " . $conexion->error;
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();
}
