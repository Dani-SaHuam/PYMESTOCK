<?php
session_start();

// Conexión a la base de datos
require 'conexion.php';

// Mensajes de alerta
$mensaje = '';

// Verificar si se ha enviado el parámetro categoria_id
if (isset($_GET['categoria_id'])) {
    $categoria_id = $_GET['categoria_id'];

    // Obtener la información de la categoría
    $sql = "SELECT * FROM categoria WHERE categoria_id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $categoria_id);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultado)) {
        $nombre = $row['nombre'];
        $descripcion = $row['descripcion'];
    } else {
        $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Categoría no encontrada.</div>';
    }
} else {
    $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">ID de categoría no válido.</div>';
}

// Procesar actualización de la categoría
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editar'])) {
    $categoria_id = $_POST['categoria_id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    // Actualizar categoría en la base de datos
    $sql_update = "UPDATE categoria SET nombre=?, descripcion=? WHERE categoria_id=?";
    $stmt_update = mysqli_prepare($conexion, $sql_update);
    mysqli_stmt_bind_param($stmt_update, 'ssi', $nombre, $descripcion, $categoria_id);

    if (mysqli_stmt_execute($stmt_update)) {
        $mensaje = '<div id="alerta" class="alert alert-success" role="alert">Categoría actualizada correctamente.</div>';
    } else {
        $mensaje = '<div id="alerta" class="alert alert-danger" role="alert">Error al actualizar la categoría: ' . mysqli_error($conexion) . '</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría - Easy-PyMEstock</title>
    <link rel="stylesheet" href="../css/editar_categoria.css">
    <link rel="icon" type="image/x-icon" href="/PyMEstock/assets/icon/icono.easy.ico">
    <script>
        // Función para ocultar el mensaje después de un tiempo determinado
        setTimeout(function() {
            var alerta = document.getElementById('alerta');
            if (alerta) {
                alerta.style.display = 'none';
            }
        }, 5000); // Oculta el mensaje después de 5 segundos (5000 milisegundos)
    </script>
</head>
<body>
    <header>
        <div class="header-left">
            <a href="home.php">
                <img src="/PyMEstock/assets/img/logo.easy.png" alt="Logo Easy-PyMEstock">
            </a>
        </div>
    </header>
    <main>
        <div class="container">
            <h2>Editar Categoría</h2>
            <?php echo $mensaje; ?>

            <!-- Formulario para editar categoría -->
            <form action="editar_categoria.php" method="post">
                <input type="hidden" name="categoria_id" value="<?php echo htmlspecialchars($categoria_id); ?>">
                <div class="form-group">
                    <label for="nombre">Nombre de la Categoría:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required><?php echo htmlspecialchars($descripcion); ?></textarea>
                </div>
                <button type="submit" name="editar" class="btn btn-primary">Actualizar Categoría</button>
            </form>
        </div>
    </main>
    <footer></footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
