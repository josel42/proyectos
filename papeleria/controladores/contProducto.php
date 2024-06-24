<?php
// Función para obtener los productos desde la base de datos
function getProductos()
{
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM productos";
    $resultado = $conexion->query($sql);

    $productos = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $productos[] = $fila;
        }
    }

    $conexion->close();

    return $productos;
}
