<?php
session_start();

if (!isset($_SESSION['idUsuario'])) {
    header("Location: index.html");
    exit();
}

include('controllers/conexion.php');
$conn = conectar();

if (!$conn) {
    die("La conexión ha fallado: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

// Paginación
$usuarios_por_pagina = 10;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($pagina_actual - 1) * $usuarios_por_pagina;

// Búsqueda
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = mysqli_real_escape_string($conn, $_GET['search']);
    $sql = "SELECT idUsuario, nombre, email, foto_perfil, rol FROM usuarios 
            WHERE nombre LIKE '%$search_query%' 
            OR email LIKE '%$search_query%' 
            LIMIT $offset, $usuarios_por_pagina";
    $sql_total = "SELECT COUNT(*) as total FROM usuarios 
                  WHERE nombre LIKE '%$search_query%' 
                  OR email LIKE '%$search_query%'";
} else {
    $sql = "SELECT idUsuario, nombre, email, foto_perfil, rol FROM usuarios 
            LIMIT $offset, $usuarios_por_pagina";
    $sql_total = "SELECT COUNT(*) as total FROM usuarios";
}

$result = mysqli_query($conn, $sql);
$result_total = mysqli_query($conn, $sql_total);
$total_usuarios = mysqli_fetch_assoc($result_total)['total'];
$total_paginas = ceil($total_usuarios / $usuarios_por_pagina);

if (!$result) {
    die("Error en la consulta: " . mysqli_error($conn));
}

include('estilos/dashboardU.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Usuarios</title>
    <link rel="stylesheet" href="estilos/estiloN.css">
    <link rel="stylesheet" href="estilos/estiloC.css">
    <link rel="stylesheet" href="estilos/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            padding: 20px;
            max-width: 900px;
            margin: auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25),
                0 10px 10px rgba(0, 0, 0, 0.22);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .btn {
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #f44336;
            color: white;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
        }

        .pagination {
            text-align: center;
            margin: 20px 0;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
        }

        .pagination a.active {
            background-color: #f44336;
            color: white;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ver Usuarios</h1>
        <div class="search-container">
            <form action="ver_usuarios.php" method="GET">
                <input type="text" placeholder="Buscar por nombre o email..." name="search" value="<?php echo htmlspecialchars($search_query, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>
        </div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Foto Perfil</th>
                    <th>Rol</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    $contador = $offset + 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $contador . "</td>";
                        echo "<td>" . htmlspecialchars($row['nombre'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td>" . htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "<td><img src='data:image/jpeg;base64," . base64_encode($row['foto_perfil']) . "' alt='Foto de perfil' class='foto-perfil'></td>";
                        echo "<td>" . htmlspecialchars($row['rol'], ENT_QUOTES, 'UTF-8') . "</td>";
                        echo "</tr>";
                        $contador++;
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
                }
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php
            for ($i = 1; $i <= $total_paginas; $i++) {
                $active_class = $i == $pagina_actual ? 'active' : '';
                echo "<a href='ver_usuarios.php?pagina=$i&search=$search_query' class='$active_class'>$i</a>";
            }
            ?>
        </div>
    </div>

    <!-- Modal para editar usuario -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('editModal')">&times;</span>
            <h2>Editar Usuario</h2>
            <form id="editForm" action="controllers/usuarios/editar_usuario.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="idUsuario" id="idUsuario">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="rol">Rol:</label>
                <select name="rol" id="rol" required>
                    <option value="usuario">Usuario</option>
                    <option value="administrador">Administrador</option>
                </select>
                <label for="foto_perfil">Foto de Perfil:</label>
                <input type="file" name="foto_perfil" id="foto_perfil">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </form>
        </div>
    </div>


    <!-- Modal para confirmar eliminación -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="cerrarModal('deleteModal')">&times;</span>
            <h2>Confirmar Eliminación</h2>
            <p>¿Está seguro de que desea eliminar este usuario?</p>
            <form id="deleteForm" action="controllers/usuarios/eliminar_usuario.php" method="GET">
                <input type="hidden" name="idUsuario" id="deleteIdUsuario">
                <button type="submit" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-secondary" onclick="cerrarModal('deleteModal')">Cancelar</button>
            </form>
        </div>
    </div>

    <script>
        function editarUsuario(id) {
            fetch(`controllers/usuarios/obtener_usuario.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        document.getElementById('idUsuario').value = data.idUsuario;
                        document.getElementById('nombre').value = data.nombre;
                        document.getElementById('email').value = data.email;
                        document.getElementById('rol').value = data.rol;
                        document.getElementById('editModal').style.display = 'block';
                    }
                })
                .catch(error => console.error('Error:', error));
        }

        function confirmarEliminar(id) {
            document.getElementById('deleteIdUsuario').value = id;
            document.getElementById('deleteModal').style.display = 'block';
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Función para obtener el valor de un parámetro en la URL
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
            var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
            var results = regex.exec(location.search);
            return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
        }

        // Mostrar alerta según el valor del parámetro "mensaje"
        document.addEventListener("DOMContentLoaded", function() {
            var mensaje = getUrlParameter('mensaje');
            if (mensaje) {
                if (mensaje === 'usuario_actualizado') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Usuario actualizado exitosamente.'
                    });
                } else if (mensaje === 'error_actualizacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al actualizar el usuario. Inténtelo de nuevo.'
                    });
                } else if (mensaje === 'usuario_eliminado') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: 'Usuario eliminado exitosamente.'
                    });
                } else if (mensaje === 'error_eliminacion') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Hubo un error al eliminar el usuario. Inténtelo de nuevo.'
                    });
                }
            }
        });
    </script>
</body>

</html>