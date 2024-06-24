<?php
include('controladores/contRecuperarContra.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="shortcut icon" href="papeleria.png">
    <link rel="stylesheet" href="style.css">
    <title>Recuperar Contraseña</title>
</head>

<body>
    <div class="login-box">
        <h2>Recuperar Contraseña</h2>
        <form id="recuperarForm" method="post" enctype="multipart/form-data">
            <div class="user-box">
                <input type="text" name="user" required>
                <label>Ingrese su Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" name="nuevaContraseña" required>
                <label>Nueva Contraseña</label>
            </div>
            <div class="user-box">
                <input type="password" name="repitaContraseña" required>
                <label>Repita la Contraseña</label>
            </div>
            <?php if (!empty($error_message)) : ?>
                <p style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <div class="button-container">
                <a href="index.php" class="btn btn-secondary">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Volver
                </a>
                <a href="#" onclick="document.getElementById('recuperarForm').submit();">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Enviar
                </a>
            </div>
        </form>
    </div>
</body>

</html>