<?php
// Conectar a la base de datos MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "file";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener el contenido del archivo
$sql = "SELECT contenido FROM archivos WHERE id = 1"; // Cambiar "id" por el id del archivo en la base de datos

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Mostrar el contenido del archivo
    $row = $result->fetch_assoc();
    echo nl2br($row["contenido"]); // nl2br para mantener los saltos de línea
} else {
    echo "No se encontró el archivo.";
}

$conn->close();
?>
