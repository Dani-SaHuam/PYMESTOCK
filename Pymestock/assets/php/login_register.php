<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy-PyMEstock - Login y Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/login_register.css"> 
    <link rel="icon" type="image/x-icon" href="../img/icono.easy.ico">
</head>
<body>

<main>
    <div class="contenedor__todo">
        <div class="caja__trasera">
            <div class="caja__trasera-login">
                <h3>¿Ya tienes una cuenta?</h3>
                <p>Inicia sesión para entrar en la página</p>
                <button id="btn__iniciar-sesion">Iniciar Sesión</button>
            </div>
            <div class="caja__trasera-register">
                <h3>¿Aún no tienes una cuenta?</h3>
                <p>Regístrate para que puedas iniciar sesión</p>
                <button id="btn__registrarse">Registrarse</button>
            </div>
        </div>

        <div class="contenedor__login-register">
            <!-- Login -->
            <form action="../php/login.php" method="POST" class="formulario__login">
                <img src="../img/logo.easy.png" alt="Logo Easy-PyMEstock" class="logo-form">
                <h2>Iniciar Sesión</h2>
                <input type="email" name="correo" id="correo" placeholder="Correo Electrónico" required>
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                <button type="submit">Entrar</button>
                <a href="https://wa.me/940931704?text=Solicito%20recuperación%20de%20contraseña" target="_blank">¿Olvidaste tu contraseña?</a>
            </form>

            <!-- Registro -->
            <form action="../php/registro_usuario.php" method="POST" class="formulario__register">
                <img src="../img/logo.easy.png" alt="Logo Easy-PyMEstock" class="logo-form">
                <h2>Registro</h2>
                <input type="text" name="n_documento" id="n_documento" placeholder="N° Documento (8 dígitos)" maxlength="8" required>
                <span id="error_documento" style="color: red; display: none;">El número de documento debe tener exactamente 8 dígitos numéricos.</span>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" required>
                <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                <input type="email" name="correo" id="correo" placeholder="Correo Electrónico" required>
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
                <button type="submit">Registrarse</button>
            </form>
        </div>
    </div>
</main>

<script src="../js/script.js"></script>

</body>
</html>
