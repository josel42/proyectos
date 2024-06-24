<?php
// Verificar si la carpeta "uploads" no existe y crearla si es necesario
$target_dir = "uploads/";
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); // 0777 otorga permisos completos
}

if(isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "El archivo ya existe.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($fileType != "txt") {
        echo "Solo se permiten archivos de texto.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "El archivo no fue subido.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "El archivo ". basename( $_FILES["fileToUpload"]["name"]). " ha sido subido correctamente.";
            
            // Leer el contenido del archivo
            $fileContent = file_get_contents($target_file);
            
            // Guardar en base de datos MySQL
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "file";

            $conn = new mysqli($servername, $username, $password, $dbname);
            
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }
            
            $sql = "INSERT INTO archivos (nombre, contenido) VALUES ('" . basename($_FILES["fileToUpload"]["name"]) . "', '" . $fileContent . "')";
            
            if ($conn->query($sql) === TRUE) {
                echo "Archivo guardado en la base de datos.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
            $conn->close();
        } else {
            echo "Error al subir el archivo.";
        }
    }
}
?>
