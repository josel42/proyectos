<?php
// Inicializa la sesión
session_start();

// Inicializa la variable de mensaje de error
$errorMessage = "";

// Conexión a la base de datos (reemplaza estos valores con los tuyos)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "papeleria";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión a la base de datos
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera las credenciales del formulario
    $username = $_POST["user"];
    $password = $_POST["pass"];
    $repeatPassword = $_POST["repeatpass"];

    // Verifica si las contraseñas son iguales
    if ($password != $repeatPassword) {
        $errorMessage = "Las contraseñas no coinciden.";
    } else {
        // Realiza la autenticación consultando la base de datos (reemplaza esto con tu propia lógica)
        $query = "SELECT * FROM usuarios WHERE usuario = '$username' AND contra = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            // Credenciales correctas, redirige a index.php
            header("Location: principal.php");
            exit();
        } else {
            // Muestra un mensaje de error si la contraseña es incorrecta
            $errorMessage = "Usuario o contraseña incorrectas.";
        }
    }
}

// Cierra la conexión a la base de datos
$conn->close();
?>