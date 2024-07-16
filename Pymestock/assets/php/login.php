<?php
session_start();
include 'conexion.php';

// Verificar si la conexión está activa
if ($conexion->ping()) {
    // Recuperar datos del formulario
    $correo = $_POST['correo'];
    $clave = $_POST['contrasena'];

    // Verificar si el usuario existe en la base de datos
    $query = "SELECT * FROM usuarios WHERE correo = ? AND clave = ?";
    $stmt = $conexion->prepare($query);
    if ($stmt) {
        $stmt->bind_param("ss", $correo, $clave);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $usuario = $result->fetch_assoc();
            $_SESSION['usuario'] = $usuario;
        } else {
            echo '<script>alert("No existe el Usuario"); window.location = "/PyMEstock/index.php";</script>';
            exit;
        }
    } else {
        echo "Error en la preparación de la consulta: " . $conexion->error;
        exit;
    }
} else {
    echo "Error: La conexión no está activa.";
    exit;
}

// Cerrar conexión
$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a PyMEstock</title>
    <link rel="stylesheet" href="/PyMEstock/assets/css/login.css">
    <link rel="icon" type="image/x-icon" href="/PyMEstock/assets/icon/icono.easy.ico">
</head>
<body>
    <header>
        <img src="/PyMEstock/assets/img/logo.easy.png" alt="Logo Easy-PyMEstock">
        <h1>Bienvenido a PyMEstock, <?php echo $_SESSION['usuario']['nombre']; ?></h1>
    </header>
    <main>
        <table>
            <tr>
                <th>Número de Documento</th>
                <td><?php echo $_SESSION['usuario']['n_documento']; ?></td>
            </tr>
            <tr>
                <th>Nombres</th>
                <td><?php echo $_SESSION['usuario']['nombre']; ?></td>
            </tr>
            <tr>
                <th>Apellidos</th>
                <td><?php echo $_SESSION['usuario']['apellidos']; ?></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td><?php echo $_SESSION['usuario']['correo']; ?></td>
            </tr>
        </table>
        <button onclick="window.location.href='/PyMEstock/assets/php/home.php'">Continuar</button>
    </main>
</body>
</html>

