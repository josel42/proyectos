<?php
$usuario = $_SESSION['nombre'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="img/logoS.png">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script defer src="https://app.embed.im/snow.js"></script>
</head>

<body class="dark">
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="img/logoS.png" alt="">
                </span>
                <div class="text logo-text">
                    <span class="name">Bienvenido</span>
                    <span class="profession"><?php echo htmlspecialchars($usuario); ?></span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle'></i>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="inicioU.php">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Inicio</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="perfilU.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Perfil</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="ver_usuariosU.php">
                            <i class='bx bx-group icon'></i>
                            <span class="text nav-text">Ver Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="verCategoriasU.php">
                            <i class='bx bx-list-ul icon'></i>
                            <span class="text nav-text">Ver Categorías</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="verProveedoresU.php">
                            <i class='bx bx-list-check icon'></i>
                            <span class="text nav-text">Ver Proveedores</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="verProductosU.php">
                            <i class='bx bx-grid-alt icon'></i>
                            <span class="text nav-text">Ver Productos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="comprar.php">
                            <i class='bx bx-grid-alt icon'></i>
                            <span class="text nav-text">Comprar</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <li class="">
                    <a href="controllers/logout.php">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Salir</span>
                    </a>
                </li>
                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Modo Oscuro</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <section class="home">
    </section>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        });

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Modo Claro";
            } else {
                modeText.innerText = "Modo Oscuro";
            }
        });
    </script>
</body>

</html>
