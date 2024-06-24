<?php
include('controllers/conexion.php');

// Verificar si se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el nombre del cliente seleccionado
    $nombreCliente = $_POST['nombreCliente'];
    
    // Obtener el ID del cliente
    $consultaCliente = "SELECT idCliente FROM clientes WHERE nombreCli = '$nombreCliente'";
    $resultadoCliente = $conexion->query($consultaCliente);
    if ($resultadoCliente === FALSE) {
        die("Error al consultar el ID del cliente: " . $conexion->error);
    }
    
    // Verificar si se encontró el cliente
    if ($resultadoCliente->num_rows > 0) {
        $filaCliente = $resultadoCliente->fetch_assoc();
        $idCliente = $filaCliente['idCliente'];
        
        // Guardar la factura
        $idProducto = $_POST['idProducto']; // Asegúrate de que este valor se esté pasando correctamente desde el formulario
        
        $cantidad = $_POST['cantidad']; // Asegúrate de que este valor se esté pasando correctamente desde el formulario
        
        // Realiza cualquier cálculo necesario para obtener el precio final y el IVA
        $precioFinal = $_POST['precioFinal']; // Asegúrate de que este valor se esté pasando correctamente desde el formulario
        $iva = $_POST['iva']; // Asegúrate de que este valor se esté pasando correctamente desde el formulario
        
        // Insertar la factura en la tabla factura
        $sql = "INSERT INTO factura (idCliente, idProducto, nombreCli, cantidad, iva, precioFinal) VALUES ($idCliente, $idProducto, '$nombreCliente', $cantidad, $iva, $precioFinal)";
        if ($conexion->query($sql) === TRUE) {
            echo "Factura guardada correctamente";
        } else {
            echo "Error al guardar la factura: " . $conexion->error;
        }
    } else {
        echo "Error: Cliente no encontrado.";
    }
    
    // Cerrar la resultadoCliente
    $resultadoCliente->close();
    // Cerrar la conexión
    $conexion->close();
}
?>
