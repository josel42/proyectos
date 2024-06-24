<?php
// Crear una nueva conexión a la base de datos
$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error al conectar con la base de datos: " . $conexion->connect_error);
}

// Consulta para obtener la lista de clientes
$consultaClientes = "SELECT nombreCli FROM clientes";
$resultadoClientes = $conexion->query($consultaClientes);

// Verificar si la consulta se realizó correctamente
if ($resultadoClientes === FALSE) {
    die("Error en la consulta de clientes: " . $conexion->error);
}
?>