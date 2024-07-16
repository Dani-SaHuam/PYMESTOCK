<?php
include 'conexion.php';

$mensaje = "";

// Guardar una nueva subcategoría
if (isset($_POST['guardar'])) {
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];

    // Validar los datos
    if (!empty($nombre) && !empty($categoria_id)) {
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $categoria_id = intval($categoria_id);

        $sql = "INSERT INTO subcategoria (nombre, categoria_id) VALUES ('$nombre', $categoria_id)";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Subcategoría guardada con éxito.";
        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Nombre y categoría son requeridos.";
    }
}

// Editar una subcategoría existente
if (isset($_POST['editar'])) {
    $subcategoria_id = $_POST['subcategoria_id'];
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];

    // Validar los datos
    if (!empty($nombre) && !empty($categoria_id) && !empty($subcategoria_id)) {
        $nombre = mysqli_real_escape_string($conexion, $nombre);
        $categoria_id = intval($categoria_id);
        $subcategoria_id = intval($subcategoria_id);

        $sql = "UPDATE subcategoria SET nombre='$nombre', categoria_id=$categoria_id WHERE subcategoria_id=$subcategoria_id";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Subcategoría editada con éxito.";
        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "Nombre, categoría y subcategoría ID son requeridos.";
    }
}

// Eliminar una subcategoría
if (isset($_GET['eliminar'])) {
    $subcategoria_id = $_GET['eliminar'];

    // Validar el ID
    if (!empty($subcategoria_id)) {
        $subcategoria_id = intval($subcategoria_id);

        $sql = "DELETE FROM subcategoria WHERE subcategoria_id=$subcategoria_id";
        if (mysqli_query($conexion, $sql)) {
            $mensaje = "Subcategoría eliminada con éxito.";
        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
        }
    } else {
        $mensaje = "ID de subcategoría es requerido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Subcategorías</title>
    <link rel="stylesheet" href="../css/sub_categoria.css">
</head>
<body>
    <header>
        <h2>Subcategorías</h2>
    </header>
    <div class="container">
        <!-- Formulario para agregar/editar subcategorías -->
        <form action="sub_categoria.php" method="post" class="form-group">
            <input type="hidden" name="subcategoria_id" id="subcategoria_id">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
            <label for="categoria_id">Categoría:</label>
            <select name="categoria_id" id="categoria_id" class="form-control" required>
                <?php
                $sql = "SELECT * FROM categoria";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<option value='" . $fila['categoria_id'] . "'>" . $fila['nombre'] . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="guardar" class="btn btn-primary">Guardar</button>
        </form>

        <!-- Mensaje de confirmación -->
        <?php if (!empty($mensaje)): ?>
            <script>
                alert('<?php echo $mensaje; ?>');
            </script>
        <?php endif; ?>

        <!-- Tabla para mostrar subcategorías -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT subcategoria.*, categoria.nombre AS categoria_nombre FROM subcategoria JOIN categoria ON subcategoria.categoria_id = categoria.categoria_id";
                $resultado = mysqli_query($conexion, $sql);
                while ($fila = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>
                            <td>{$fila['subcategoria_id']}</td>
                            <td>{$fila['nombre']}</td>
                            <td>{$fila['categoria_nombre']}</td>
                            <td>" . ($fila['estado'] ? 'Activo' : 'Inactivo') . "</td>
                            <td>{$fila['fecha_creacion']}</td>
                            <td>
                                <a href='editar_subcategoria.php?editar={$fila['subcategoria_id']}' class='btn btn-editar'>Editar</a>
                                <a href='sub_categoria.php?eliminar={$fila['subcategoria_id']}' class='btn btn-danger'>Eliminar</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
