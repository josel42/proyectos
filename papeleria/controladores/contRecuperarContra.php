<?php
// Conexión a la base de datos (reemplaza con tus propios detalles)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papeleria";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Inicializar mensaje de error
$error_message = "";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar datos del formulario
    $username = $_POST["user"];
    $nuevaContraseña = $_POST["nuevaContraseña"];
    $repitaContraseña = $_POST["repitaContraseña"];
    // Verificar si el usuario existe en la base de datos
    $sql = "SELECT * FROM usuarios WHERE usuario = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Verificar si las contraseñas son iguales
        if ($nuevaContraseña == $repitaContraseña) {
            // Actualizar la contraseña en la base de datos
            $update_sql = "UPDATE usuarios SET contra = '$nuevaContraseña' WHERE usuario = '$username'";
            mysqli_query($conn, $update_sql);
            $error_message = "<span style='color: green;'>Contraseña cambiada correctamente.</span>";
        } else {
            // Contraseñas no coinciden, mostrar mensaje de error
            $error_message = "Las contraseñas no coinciden.";
        }
    } else {
        // Usuario no encontrado
        $error_message = "Usuario no encontrado.";
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);
