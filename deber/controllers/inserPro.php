<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombreCli = $_POST['nombrePro'];
    $apellidoCli = $_POST['precioPro'];
    $direccionCli = $_POST['stockPro'];
    $telefonoCli = $_POST['descripcionPro'];

    // Procesar la imagen de perfil
    $imagenPerfil = $_FILES['fotoProducto']['tmp_name'];
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
    $sql = "INSERT INTO productos (nombrePro, precioPro, stockPro, descripcionPro, fotoProducto) VALUES ('$nombreCli', '$apellidoCli', '$direccionCli', '$telefonoCli', '$imagenPerfilContenido')";
    
    // Ejecutar la consulta
    if ($conexion_insertar->query($sql) === TRUE) {
    } else {
        echo "Error al insertar producto: " . $conexion_insertar->error;
    }

    // Cerrar la conexión
    $conexion_insertar->close();
}
?>