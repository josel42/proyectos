<?php
include('controladores/navbar.php');
include('controladores/contCreateProdu.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creacion de Productos</title>
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
            color: #FFA200;
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

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Puedes agregar tu contenido principal aquí -->
        <div class="container">
            <h1>Creacion de Productos</h1>
            <form action="" method="post">
                <!-- Campos del formulario con valores actuales -->
                <input type="hidden" name="prodId" value="<?php echo $userData['idProducto']; ?>">
                <div class="form-group row">
                    <label for="crearNombre" class="col-sm-3 col-form-label">Nombre:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="nombre" required placeholder="Ingrese el nombre del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearDescripcion" class="col-sm-3 col-form-label">Descripcion:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="descripcion" required placeholder="Ingrese la descripcion del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearPrecio" class="col-sm-3 col-form-label">Precio:</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="precio" required placeholder="Ingrese el precio del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearStock" class="col-sm-3 col-form-label">Stock:</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="stock" required placeholder="Ingrese el stock del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearCantidad" class="col-sm-3 col-form-label">Cantidad:</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" name="cantidad" required placeholder="Ingrese la cantidad del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearFechacreacion" class="col-sm-3 col-form-label">Fecha de Creacion:</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="fechaCreacion" required placeholder="Ingrese la fecha de creacion">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearCategoria" class="col-sm-3 col-form-label">Categoria:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="categoria" required placeholder="Ingrese la categoria del producto">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="crearProveedor" class="col-sm-3 col-form-label">Proveedor:</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="proveedor" required placeholder="Ingrese el proveedor del producto">
                    </div>
                </div>
                <!-- Botones de acción -->
                <!-- Botones de acción -->
                <div class="form-group row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-dark" name="submit" value="Crear Usuario">Crear Producto</button>
                        <a href="productos.php" class="btn btn-secondary">Volver</a>
                    </div>
                    <center>
                        <?php if (!empty($error_message)) : ?>
                            <p style="color: red;"><?php echo $error_message; ?></p>
                        <?php endif; ?>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <!-- /.content-wrapper -->

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