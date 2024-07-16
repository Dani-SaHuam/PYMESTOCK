<?php
include 'conexion.php';

// Verificar si la conexión está activa
if ($conexion->ping()) {
    // Recuperar datos del formulario
    $n_documento = $_POST['n_documento'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $clave = $_POST['contrasena'];

    // Verificar que el correo no se repita en la base de datos
    $verificar_correo = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $verificar_correo->bind_param("s", $correo);
    $verificar_correo->execute();
    $verificar_correo->store_result();

    if ($verificar_correo->num_rows > 0) {
        echo '<script>alert("Este correo ya está registrado, intentalo con otro diferente"); window.location = "/PyMEstock/index.php";</script>';
        exit;
    }

    $verificar_correo->close();

    // Crear consulta SQL usando sentencia preparada
    $query = "INSERT INTO usuarios (n_documento, nombre, apellidos, correo, clave) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($query);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt) {
        // Vincular parámetros
        $stmt->bind_param("sssss", $n_documento, $nombre, $apellidos, $correo, $clave);

        // Ejecutar consulta
        if ($stmt->execute()) {
            echo '<script>alert("Usuario almacenado exitosamente"); window.location = "/PyMEstock/index.php";</script>';
        } else {
            echo '<script>alert("Usuario no almacenado exitosamente"); window.location = "/PyMEstock/index.php";</script>';
        }

        // Cerrar sentencia preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
    }
} else {
    echo "Error: La conexión no está activa.";
}

// Cerrar conexión
$conexion->close();
?>
