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

// Verifica si se ha enviado el formulario de eliminación
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarProducto'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "papeleria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $prodId = $_POST['prodId'];

    $sql = "DELETE FROM productos WHERE idProducto = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prodId);

    if ($stmt->execute()) {
        echo '<script>window.location.href = "productos.php";</script>';
        exit();
    } else {
        // Manejar el caso de fallo
        $error_message = "Error al eliminar el producto.";
    }

    $stmt->close();
    $conn->close();
} else {
    $conn = new mysqli("localhost", "root", "", "papeleria");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $prodId = $_GET['id'];

    // Obtén los datos del producto que se va a visualizar
    $prodData = getProductoById($conn, $prodId);

    // Renderiza el formulario solo si se proporcionan los datos del producto
    if (!empty($prodData)) {
        renderizarFormulario($prodData);
    } else {
        echo "Producto no encontrado.";
    }

    $conn->close();
}
