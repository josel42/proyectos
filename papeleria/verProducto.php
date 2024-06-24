<?php
include('controladores/navbar.php');
include('controladores/contVerProdu.php');

function renderizarFormulario($prodData)
{
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ver Producto</title>
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
                color: #1AD3DC;
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
                <h1>Visualizar Producto</h1>
                <form action="" method="post">
                    <!-- Campos del formulario con valores actuales -->
                    <input type="hidden" name="prodId" value="<?php echo $prodData['idProducto']; ?>">
                    <div class="form-group row">
                        <label for="nuevoNombre" class="col-sm-3 col-form-label">Nombre del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoNombre" required placeholder="Ingrese el nuevo nombre del producto" value="<?php echo htmlspecialchars($prodData['nombreProducto']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevaDescripcion" class="col-sm-3 col-form-label">Descripción del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevaDescripcion" required placeholder="Ingrese la nueva descripción" value="<?php echo htmlspecialchars($prodData['descripcion']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoPrecio" class="col-sm-3 col-form-label">Precio del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoPrecio" required placeholder="Ingrese el nuevo precio" value="<?php echo htmlspecialchars($prodData['precio']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoStock" class="col-sm-3 col-form-label">Stock del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoStock" required placeholder="Ingrese el nuevo stock" value="<?php echo htmlspecialchars($prodData['stock']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevaCantidad" class="col-sm-3 col-form-label">Cantidad del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevaCantidad" required placeholder="Ingrese la nueva cantidad" value="<?php echo htmlspecialchars($prodData['cantidad']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevaCategoria" class="col-sm-3 col-form-label">Categoría del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevaCategoria" required placeholder="Ingrese la nueva categoría" value="<?php echo htmlspecialchars($prodData['categoria']); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nuevoProveedor" class="col-sm-3 col-form-label">Proveedor del Producto:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nuevoProveedor" required placeholder="Ingrese el nuevo proveedor" value="<?php echo htmlspecialchars($prodData['proveedor']); ?>" readonly>
                        </div>
                    </div>
                    <!-- Botones de acción -->
                    <div class="form-group row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <a href="productos.php" class="btn btn-info">Volver</a>
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
