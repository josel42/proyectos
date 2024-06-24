<?php
include("controladores/config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="papeleria.png">
    <link rel="stylesheet" href="style.css">
    <title>Login de Papeleria</title>
</head>

<body>
    <div class="login-box">
        <h2>Bienvenido</h2>
        <form method="post" action="" id="loginForm">
            <div class="user-box">
                <input type="text" name="user" required>
                <label>Usuario</label>
            </div>
            <div class="user-box">
                <input type="password" name="pass" required>
                <label>Contraseña</label>
            </div>
            <div class="user-box">
                <input type="password" name="repeatpass" required>
                <label>Repita la Contraseña</label>
            </div>
            <center>
                <a href="#" onclick="document.getElementById('loginForm').submit();">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Login
                </a>
            </center>
            <br>
            <?php
            // Mostrar mensaje de error si existe
            if (!empty($errorMessage)) {
                echo "<p style='color: red;'>$errorMessage</p>";
            }
            ?>
        </form>
        <p style="color: white;">¿Has olvidado la contraseña? <a href="recuperarContra.php">Recupérala aquí</a></p>

    </div>
</body>

</html>