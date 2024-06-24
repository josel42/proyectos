<?php
include('controladores/navbar.php');
include('controladores/contEditUsuario.php');

function renderizarFormulario($userData)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuario</title>
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
                color: #0D7BFF;
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
                <h1>Editar Usuario</h1>
                <form action="" method="post">
                    <!-- Campos del formulario con valores actuales -->
                    <input type="hidden" name="userId" value="<?php echo $userData['idUsuario']; ?>">
                    <div class="form-group row">
                        <label for="nuevoNombre" class="col-sm-3 col-form-label">Nuevo Nombre:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoNombre" required placeholder="Ingrese el nuevo nombre" value="<?php echo htmlspecialchars($userData['nombreUsuario']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoApellido" class="col-sm-3 col-form-label">Nuevo Apellido:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoApellido" required placeholder="Ingrese el nuevo apellido" value="<?php echo htmlspecialchars($userData['apellido']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoUsuario" class="col-sm-3 col-form-label">Nuevo Usuario:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoUsuario" required placeholder="Ingrese el nuevo usuario" value="<?php echo htmlspecialchars($userData['usuario']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevaContra" class="col-sm-3 col-form-label">Nueva Contraseña:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevaContra" required placeholder="Ingrese la nueva contraseña" value="<?php echo htmlspecialchars($userData['contra']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevaEdad" class="col-sm-3 col-form-label">Nueva Edad:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevaEdad" required placeholder="Ingrese la nueva edad" value="<?php echo htmlspecialchars($userData['edad']); ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoEmail" class="col-sm-3 col-form-label">Nuevo Email:</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="nuevoEmail" required placeholder="Ingrese el nuevo email" value="<?php echo htmlspecialchars($userData['email']); ?>">
                        </div>
                    </div>
                    <!-- Botones de acción -->
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <a href="usuarios.php" class="btn btn-secondary">Cancelar</a>
                        </div>
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