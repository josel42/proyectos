<?php
include('controladores/navbar.php');
include('controladores/contEliminarUsuario.php');

function renderizarFormulario($userData)
{
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            background-color: #3498db;
            color: #ecf0f1;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .content-wrapper {
            background-color: #ffffff;
            color: #2C3E50;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px;
        }

        .container {
            margin-top: 20px;
        }

        h1 {
            color: #F42323;
        }

        .main-footer {
            background-color: #2C3E50;
            color: #ecf0f1;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: left;
        }

        .social-icon {
            margin-right: 10px;
            color: #ecf0f1;
        }
    </style>
</head>

<body>

    <div class="content-wrapper">
        <div class="container">
            <h1>Eliminar Usuario</h1>
            <form action="" method="post">
                <!-- Campos del formulario con valores actuales -->
                <input type="hidden" name="userId" value="<?php echo $userData['idUsuario']; ?>">
                <div class="form-group row">
                    <label for="nuevoNombre" class="col-sm-3 col-form-label">Nombre:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevoNombre" required value="<?php echo htmlspecialchars($userData['nombreUsuario']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nuevoApellido" class="col-sm-3 col-form-label">Apellido:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevoApellido" required value="<?php echo htmlspecialchars($userData['apellido']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nuevoUsuario" class="col-sm-3 col-form-label">Usuario:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevoUsuario" required value="<?php echo htmlspecialchars($userData['usuario']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nuevaContra" class="col-sm-3 col-form-label">Contraseña:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevaContra" required value="<?php echo htmlspecialchars($userData['contra']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nuevaEdad" class="col-sm-3 col-form-label">Edad:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevaEdad" required value="<?php echo htmlspecialchars($userData['edad']); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nuevoEmail" class="col-sm-3 col-form-label">Email:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nuevoEmail" required value="<?php echo htmlspecialchars($userData['email']); ?>" readonly>
                    </div>
                </div>
                <!-- Botones de acción -->
                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                    <button type="submit" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea eliminar este usuario?');" name="eliminarUsuario">Eliminar</button>
                        <a href="usuarios.php" class="btn btn-secondary">Volver</a>
                    </div>
                    <?php if (!empty($error_message)) : ?>
                        <p style="color: red;"><?php echo $error_message; ?></p>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="float-right d-none d-sm-block">
                <b>Versión</b> 3.1.0
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
            </div>
            <strong>&copy; <?php echo date("Y"); ?> Papeleria</strong>
        </div>
    </footer>

</body>

</html>
<?php
}
?>