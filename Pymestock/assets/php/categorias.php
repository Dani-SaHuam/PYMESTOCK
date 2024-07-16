<?php
session_start();

// Conexión a la base de datos
require 'conexion.php';

// Función para limpiar y validar datos
function validarDatos($dato) {
    $dato = trim($dato);
    $dato = stripslashes($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Mensajes de alerta
$mensaje = '';

// Procesar formulario de agregar o actualizar categoría
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accion'])) {
        if ($_POST['accion'] == 'agregar') {
            // Validar y limpiar los datos del formulario
            $nombre = validarDatos($_POST['nombre']);
            $descripcion = validarDatos($_POST['descripcion']);

            // Verificar si el nombre de la categoría ya existe
            $sql_check = "SELECT * FROM categoria WHERE nombre = '$nombre'";
            $result_check = mysqli_query($conexion, $sql_check);
            if (mysqli_num_rows($result_check) > 0) {
                $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Ya existe una categoría con ese nombre.</div>';
            } else {
                // Insertar nueva categoría en la base de datos
                $sql_insert = "INSERT INTO categoria (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
                if (mysqli_query($conexion, $sql_insert)) {
                    $mensaje = '<div id="alerta" class="alert alert-success" role="alert">Categoría agregada correctamente.</div>';
                } else {
                    $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Error al agregar la categoría: ' . mysqli_error($conexion) . '</div>';
                }
            }
        } elseif ($_POST['accion'] == 'editar') {
            // Validar y limpiar los datos del formulario
            $categoria_id = validarDatos($_POST['categoria_id']);
            $nombre = validarDatos($_POST['nombre']);
            $descripcion = validarDatos($_POST['descripcion']);

            // Verificar si el nombre de la categoría ya existe (excluyendo la categoría actual)
            $sql_check = "SELECT * FROM categoria WHERE nombre = '$nombre' AND categoria_id != $categoria_id";
            $result_check = mysqli_query($conexion, $sql_check);
            if (mysqli_num_rows($result_check) > 0) {
                $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Ya existe una categoría con ese nombre.</div>';
            } else {
                // Actualizar categoría en la base de datos
                $sql_update = "UPDATE categoria SET nombre='$nombre', descripcion='$descripcion' WHERE categoria_id=$categoria_id";
                if (mysqli_query($conexion, $sql_update)) {
                    $mensaje = '<div id="alerta" class="alert alert-success" role="alert">Categoría actualizada correctamente.</div>';
                } else {
                    $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Error al actualizar la categoría: ' . mysqli_error($conexion) . '</div>';
                }
            }
        }
    }
}

// Procesar eliminación de categoría
if (isset($_GET['eliminar'])) {
    $categoria_id = validarDatos($_GET['eliminar']);
    $sql = "DELETE FROM categoria WHERE categoria_id=$categoria_id";
    if (mysqli_query($conexion, $sql)) {
        $mensaje = '<div id="alerta" class="alert alert-success" role="alert">Categoría eliminada correctamente.</div>';
    } else {
        $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Error al eliminar la categoría: ' . mysqli_error($conexion) . '</div>';
    }
}

// Filtrar categorías
$filtro = "";
if (isset($_POST['buscar'])) {
    $filtro = validarDatos($_POST['filtro']);
    $criterio = validarDatos($_POST['criterio']);
    $sql = "SELECT * FROM categoria WHERE $criterio LIKE '%$filtro%'";
} else {
    // Obtener todas las categorías de la base de datos
    $sql = "SELECT * FROM categoria";
}
$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías - Easy-PyMEstock</title>
    <link rel="stylesheet" href="/PyMEstock/assets/css/categorias.css">
    <link rel="icon" type="image/x-icon" href="/PyMEstock/assets/icon/icono.easy.ico">
    <script>
        // Función para ocultar el mensaje después de un tiempo determinado
        setTimeout(function() {
            document.getElementById('alerta').style.display = 'none';
        }, 5000); // Oculta el mensaje después de 5 segundos (5000 milisegundos)
    </script>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="/PyMEstock/assets/img/logo.easy.png" alt="Logo Easy-PyMEstock">
        </div>
    </header>
    <main>
        <div class="container">
            <h2>CATEGORIAS</h2>
            <?php echo $mensaje; ?>

            <!-- Formulario para agregar categoría -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="accion" value="agregar">
                <div class="form-group">
                    <label for="nombre">Nombre de la Categoría:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Categoría</button>
            </form>

            <hr>

            <!-- Formulario de búsqueda -->
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label for="criterio">Buscar por:</label>
                    <select name="criterio" id="criterio" class="form-control">
                        <option value="categoria_id">ID</option>
                        <option value="nombre">Nombre</option>
                        <option value="descripcion">Descripción</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="filtro">Criterio de búsqueda:</label>
                    <input type="text" class="form-control" id="filtro" name="filtro" required>
                </div>
                <button type="submit" class="btn btn-primary" name="buscar">Buscar</button>
                <a href="../php/sub_categoria.php" class="btn btn-secondary" style="background-color:#28a745; color: #fff;">VER SUB-CATEGORIAS</a>
            </form>

            <hr>

            <!-- Mostrar categorías existentes -->
            <h3>Categorías Actuales</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($resultado) > 0) {
                        while ($row = mysqli_fetch_assoc($resultado)) {
                            echo "<tr>";
                            echo "<td>" . $row['categoria_id'] . "</td>";
                            echo "<td>" . $row['nombre'] . "</td>";
                            echo "<td>" . $row['descripcion'] . "</td>";
                            echo '<td>
                                    <a href="editar_categoria.php?id=' . $row['categoria_id'] . '" class="btn btn-sm btn-primary">Editar</a>
                                    <a href="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '?eliminar=' . $row['categoria_id'] . '" class="btn btn-sm btn-danger">Eliminar</a>
                                  </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="4">No hay categorías registradas.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Cerrar conexión a la base de datos
mysqli_close($conexion);
?>
