<?php

// Función para obtener los datos del usuario por ID
function getUsuarioById($conn, $userId)
{
    $sql = "SELECT * FROM usuarios WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarUsuario'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "papeleria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $userId = $_POST['userId'];

    // Eliminar usuario
    $sql = "DELETE FROM usuarios WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo '<script>window.location.href = "usuarios.php";</script>';
        exit();
    } else {
        // Manejar el caso de fallo
    }

    $stmt->close();
    $conn->close();
} else {
    $conn = new mysqli("localhost", "root", "", "papeleria");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $userId = $_GET['id'];

    // Obtén los datos del usuario que se va a eliminar
    $userData = getUsuarioById($conn, $userId);

    // Renderiza el formulario solo si se proporcionan los datos del usuario
    if (!empty($userData)) {
        renderizarFormulario($userData);
    } else {
        echo "Usuario no encontrado.";
    }

    $conn->close();
}
