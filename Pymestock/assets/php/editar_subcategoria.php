<?php
include 'conexion.php';

// Obtener subcategoría a editar
$subcategoria_id = $_GET['id'];
$query = "SELECT * FROM subcategoria WHERE subcategoria_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param('i', $subcategoria_id);
$stmt->execute();
$result = $stmt->get_result();
$subcategoria = $result->fetch_assoc();

// Procesar el formulario de editar subcategoría
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $estado = $_POST['estado'];

    // Actualizar subcategoría
    $query = "UPDATE subcategoria SET nombre = ?, categoria_id = ?, estado = ? WHERE subcategoria_id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param('siii', $nombre, $categoria_id, $estado, $subcategoria_id);

    if ($stmt->execute()) {
        echo "<script>alert('Subcategoría actualizada correctamente');</script>";
    } else {
        echo "<script>alert('Error al actualizar la subcategoría');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Subcategoría</title>
    <link rel="stylesheet" href="../css/guardar_editar_subcategoria.css">
</head>
<body>
    <header>
        <img src="assets/img/logo.easy.png" alt="Logo">
        <h1>Editar Subcategoría</h1>
    </header>
    <div class="container">
        <form method="POST" action="editar_subcategorias.php?id=<?php echo $subcategoria['subcategoria_id']; ?>">
            <div class="form-group">
                <label for="nombre">Nombre de la Subcategoría</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $subcategoria['nombre']; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría</label>
                <input type="number" class="form-control" id="categoria_id" name="categoria_id" value="<?php echo $subcategoria['categoria_id']; ?>" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <select class="form-control" id="estado" name="estado">
                    <option value="1" <?php if ($subcategoria['estado'] == 1) echo 'selected'; ?>>Activo</option>
                    <option value="0" <?php if ($subcategoria['estado'] == 0) echo 'selected'; ?>>Inactivo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
</body>
</html>
