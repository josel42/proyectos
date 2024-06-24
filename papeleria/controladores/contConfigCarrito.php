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

// Función para obtener los usuarios desde la base de datos
function getUsuarios()
{
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    $usuarios = array();

    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            $usuarios[] = $fila;
        }
    }

    $conexion->close();

    return $usuarios;
}

// Función para agregar productos a la factura
function agregarAFactura($usuarioId, $productoId)
{
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Obtener información del usuario
    $sqlUsuario = "SELECT * FROM usuarios WHERE idUsuario = $usuarioId";
    $resultadoUsuario = $conexion->query($sqlUsuario);

    if ($resultadoUsuario->num_rows > 0) {
        $usuario = $resultadoUsuario->fetch_assoc();
    } else {
        die("Error: Usuario no encontrado");
    }

    // Obtener información del producto
    $sqlProducto = "SELECT * FROM productos WHERE idProducto = $productoId";
    $resultadoProducto = $conexion->query($sqlProducto);

    if ($resultadoProducto->num_rows > 0) {
        $producto = $resultadoProducto->fetch_assoc();
    } else {
        die("Error: Producto no encontrado");
    }

    // Insertar en la tabla factura
    $nombreUsuario = $usuario['nombreUsuario'];
    $correoUsuario = $usuario['email'];
    $nombreProducto = $producto['nombreProducto'];
    $precioProducto = $producto['precio'];
    $cantidadProducto = $producto['cantidad'];
    $stockProducto = $producto['stock'];

    $sqlInsertarFactura = "INSERT INTO factura (nombreUsuario, correo, nombreProducto, precio, cantidad, stock)
                           VALUES ('$nombreUsuario', '$correoUsuario', '$nombreProducto', $precioProducto, 1, $stockProducto)";

    if ($conexion->query($sqlInsertarFactura) === TRUE) {
        echo "Producto con ID $productoId añadido a la factura para el usuario con ID $usuarioId.";
    } else {
        echo "Error al añadir el producto a la factura: " . $conexion->error;
    }

    $conexion->close();
}

// Función para borrar un producto de la factura
function borrarDeFactura($facturaId)
{
    $conexion = new mysqli("localhost", "root", "", "papeleria");

    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Eliminar producto de la factura
    $sqlBorrarFactura = "DELETE FROM factura WHERE idFactura = $facturaId";

    if ($conexion->query($sqlBorrarFactura) === TRUE) {
        echo "Producto con ID $facturaId eliminado de la factura.";
    } else {
        echo "Error al eliminar el producto de la factura: " . $conexion->error;
    }

    $conexion->close();
}

// Verificar si se ha enviado el formulario y se hizo clic en el botón "agregarFactura"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregarFactura'])) {
    // Verificar si los valores de usuario y producto están presentes
    if (isset($_POST['usuario']) && isset($_POST['producto'])) {
        // Obtener los valores del formulario
        $usuarioId = $_POST['usuario'];
        $productoId = $_POST['producto'];

        // Llamar a la función para agregar productos a la factura
        agregarAFactura($usuarioId, $productoId);
    } else {
        echo "Error: Debes seleccionar un usuario y un producto.";
    }
}

// Verificar si se ha enviado el formulario y se hizo clic en el botón "borrarFactura"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['borrarFactura'])) {
    // Verificar si el valor de factura está presente
    if (isset($_POST['factura'])) {
        // Obtener el valor del formulario
        $facturaId = $_POST['factura'];

        // Llamar a la función para borrar productos de la factura
        borrarDeFactura($facturaId);
    } else {
        echo "Error: Debes seleccionar un producto para borrar de la factura.";
    }
}

// Verificar si se ha enviado el formulario y se hizo clic en el botón "comprarFactura"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['comprarFactura'])) {
    // Redirigir a la página de compra
    echo '<script>window.location.href = "factura.php";</script>';
    exit();
}
?>