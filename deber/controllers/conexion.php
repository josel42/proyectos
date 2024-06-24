<?php

// Datos de conexión
$host = "localhost";
$usuario = "root";
$contrasena = "";
$base_datos = "deber";

// Intentar conectarse a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
} else {
}

// Cerrar la conexión
$conexion->close();

?>
