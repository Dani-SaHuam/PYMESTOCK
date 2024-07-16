<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basededatos = "db_pymestock";

// Crear la conexión
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);
mysqli_set_charset($conexion, "utf8");

//Verificar la conexión
/*if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
} else {
    echo "Conectado exitosamente a la base de datos";
    
}*/
?>
