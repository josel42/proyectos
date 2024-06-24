<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreCli = $_POST['nombreCli'];
    $apellidoCli = $_POST['apellidoCli'];
    $direccionCli = $_POST['direccionCli'];
    $telefonoCli = $_POST['telefonoCli'];

    // Procesar la imagen de perfil
    $imagenPerfil = $_FILES['imagenPerfil']['tmp_name'];
    if ($imagenPerfil != "") {
        $imagenPerfilContenido = addslashes(file_get_contents($imagenPerfil)); // Convertir la imagen a formato BLOB
    } else {
        $imagenPerfilContenido = NULL;
    }

    // Crear una nueva conexión a la base de datos
    $conexion_insertar = new mysqli($host, $usuario, $contrasena, $base_datos);

    // Verificar la conexión
    if ($conexion_insertar->connect_error) {
        die("Error al conectar con la base de datos: " . $conexion_insertar->connect_error);
    }

    // Insertar datos en la tabla de clientes
    $sql = "INSERT INTO clientes (nombreCli, apellidoCli, direccionCli, telefonoCli, imagenPerfil) VALUES ('$nombreCli', '$apellidoCli', '$direccionCli', '$telefonoCli', '$imagenPerfilContenido')";
    
    // Ejecutar la consulta
    if ($conexion_insertar->query($sql) === TRUE) {
    } else {
        echo "Error al insertar el registro de cliente: " . $conexion_insertar->error;
    }

    // Cerrar la conexión
    $conexion_insertar->close();
}
?>