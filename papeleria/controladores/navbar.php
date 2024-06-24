<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papeleria</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">
    <link rel="shortcut icon" href="papeleria.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Abel&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Abel&family=Exo+2:ital,wght@0,100..900;1,100..900&family=Oswald:wght@200..700&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #0D3B66;
            background: -webkit-linear-gradient(to right, #0D3B66, #1A1A1A);
            background: linear-gradient(to right, #0D3B66, #1A1A1A);
            color: #f2f2f2;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
            padding: 10px;
            color: #110F0F;
            font-family: 'Oswald', sans-serif;
        }

        h2 {
            font-family: 'Playfair Display', serif;
            color: #2C3E50;
        }

        h3 {
            font-family: 'Exo 2', sans-serif;
            color: #000000;
        }

        p {
            font-family: 'Oswald', sans-serif;
            color: #FFFFFF;
        }

        /* Estilo del Navbar */
        .navbar {
            background-color: #2C3E50;
            color: #ecf0f1;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #ecf0f1;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #FFD700;
        }

        /* Estilo del Sidebar */
        .main-sidebar {
            background-color: #34495E;
            color: #ecf0f1;
        }

        .brand-text {
            color: #FFD700;
        }

        .nav-sidebar .nav-item .nav-link {
            color: #ecf0f1;
            transition: color 0.3s ease-in-out;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            color: #FFD700;
            transform: scale(1.05);
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <!-- Agrega más elementos según tus necesidades -->
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color: white;"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="principal.php" class="brand-link">
                <span class="brand-text font-weight-light">Papeleria</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Puedes personalizar y expandir la lista de elementos según tus necesidades -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="usuarios.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <!-- Agrega más elementos según tus necesidades -->
                        <li class="nav-item">
                            <a href="create.php" class="nav-link">
                                <i class="nav-icon fas fa-pencil-alt"></i>
                                <p>Creación de Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="productos.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="createProdu.php" class="nav-link">
                                <i class="nav-icon fas fa-plus-circle"></i>
                                <p>Creación de Productos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="carrito.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Carrito de Compras</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>
    </div>
</body>

</html>