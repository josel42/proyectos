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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "papeleria";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $userId = $_POST['userId'];
    $nuevoNombre = $_POST['nuevoNombre'];
    $nuevoApellido = $_POST['nuevoApellido'];
    $nuevoUsuario = $_POST['nuevoUsuario'];
    $nuevaContra = $_POST['nuevaContra'];
    $nuevaEdad = $_POST['nuevaEdad'];
    $nuevoEmail = $_POST['nuevoEmail'];

    $sql = "UPDATE usuarios SET nombreUsuario = ?, apellido = ?, usuario = ?, 
            contra = ?, edad = ?, email = ? WHERE idUsuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssisi", $nuevoNombre, $nuevoApellido, $nuevoUsuario, $nuevaContra, $nuevaEdad, $nuevoEmail, $userId);

    if ($stmt->execute()) {
        echo "Usuario actualizado correctamente.";
    } else {
        echo "Error al actualizar el usuario: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $conn = new mysqli("localhost", "root", "", "papeleria");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $userId = $_GET['id'];

    // Obtén los datos del usuario que se va a editar
    $userData = getUsuarioById($conn, $userId);

    // Renderiza el formulario solo si se proporcionan los datos del usuario
    if (!empty($userData)) {
        renderizarFormulario($userData);
    } else {
        echo "Usuario no encontrado.";
    }

    $conn->close();
}
