<?php
// Función para obtener los datos del producto por ID
function getProductoById($conn, $productId)
{
    $sql = "SELECT * FROM productos WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "papeleria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $prodId = $_POST['prodId'];
    $nuevoNombre = htmlspecialchars($_POST['nuevoNombre']);
    $nuevaDescripcion = htmlspecialchars($_POST['nuevaDescripcion']);

    // Asegurarse de que el precio sea un número decimal
    $nuevoPrecio = $_POST['nuevoPrecio'];
    if (!preg_match('/^\d+(\.\d+)?$/', $nuevoPrecio)) {
        $error_message = "Ingrese un número decimal válido para el precio.";
    } else {
        $nuevoPrecio = htmlspecialchars($nuevoPrecio);
    }

    $nuevoStock = htmlspecialchars($_POST['nuevoStock']);
    $nuevaCantidad = htmlspecialchars($_POST['nuevaCantidad']);
    $nuevaCategoria = htmlspecialchars($_POST['nuevaCategoria']);
    $nuevoProveedor = htmlspecialchars($_POST['nuevoProveedor']);

    $sql = "UPDATE productos SET nombreProducto = ?, descripcion = ?, precio = ?, 
            stock = ?, cantidad = ?, categoria = ?, proveedor = ? WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdsisssi", $nuevoNombre, $nuevaDescripcion, $nuevoPrecio, $nuevoStock, $nuevaCantidad, $nuevaCategoria, $nuevoProveedor, $prodId);

    if ($stmt->execute()) {
        echo '<script>window.location.href = "productos.php";</script>';
        exit();
    } else {
        // Manejar el caso de fallo
        $error_message = "Error al actualizar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    $conn = new mysqli("localhost", "root", "", "papeleria");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $prodId = $_GET['id'];

    // Obtén los datos del producto que se va a editar
    $prodData = getProductoById($conn, $prodId);

    // Renderiza el formulario solo si se proporcionan los datos del producto
    if (!empty($prodData)) {
        renderizarFormulario($prodData);
    } else {
        echo "Producto no encontrado.";
    }

    $conn->close();
}
