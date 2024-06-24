<?php
require 'conexion.php'; // Asegúrate de la ruta correcta al archivo de conexión

$conn = conectar();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $contraNueva = $_POST['contraNueva'];
    $contraRepetir = $_POST['contraRepetir'];

    // Verificar si las contraseñas coinciden
    if ($contraNueva !== $contraRepetir) {
        header("Location: ../olvido.php?error=contraseñas_no_coinciden");
        exit;
    }

    // Verificar si el correo existe en la base de datos
    $query = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $query->bind_param("s", $correo);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Encriptar la nueva contraseña
        $contraseña_encriptada = password_hash($contraNueva, PASSWORD_BCRYPT);

        // Actualizar la contraseña en la base de datos
        $query = $conn->prepare("UPDATE usuarios SET password = ? WHERE email = ?");
        $query->bind_param("ss", $contraseña_encriptada, $correo);
        if ($query->execute()) {
            header("Location: ../olvido.php?success");
        } else {
            header("Location: ../olvido.php?error=error_restauracion");
        }
    } else {
        header("Location: ../olvido.php?error=correo_no_encontrado");
    }
}
?>
