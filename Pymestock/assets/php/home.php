<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Easy-PyMEstock</title>
    <link rel="stylesheet" href="/PyMEstock/assets/css/home.css">
    <link rel="icon" type="image/x-icon" href="/PyMEstock/assets/icon/icono.easy.ico">
    <script>
        function mostrarMensaje(mensaje) {
            var alertBox = document.getElementById('alertBox');
            var alertContent = document.getElementById('alertContent');
            alertContent.innerHTML = mensaje;
            alertBox.style.display = 'flex'; // Cambiado a 'flex' para centrar vertical y horizontalmente
        }

        function cerrarAlerta() {
            var alertBox = document.getElementById('alertBox');
            alertBox.style.display = 'none';
        }
    </script>
</head>
<body>
    <header>
        <div class="header-left">
            <img src="/PyMEstock/assets/img/logo.easy.png" alt="Logo Easy-PyMEstock">
        </div>
        <div class="header-center">
            <?php 
            session_start(); // Iniciar sesión si aún no está iniciada
            if (isset($_SESSION['usuario'])) {
                $usuario = $_SESSION['usuario'];
                echo '<h1>' . $usuario['nombre'] . ' ' . $usuario['apellidos'] . '</h1>';
            }
            ?>
        </div>
        <div class="header-right">
            <button class="ayuda" onclick="window.location.href='mailto:info@easypymestock.com'">Ayuda</button>
            <button class="cerrar-sesion" onclick="window.location.href='/Pymestock/index.php'">Cerrar Sesión</button>
        </div>
    </header>
    <main>
        <section class="section section-categorias">
            <h2>CATEGORÍAS</h2>
            <a href="../php/categorias.php"><img src="/PyMEstock/assets/img/categorias.jpg" alt="Categorías"></a>
        </section>
        <section class="section section-productos">
            <h2>PRODUCTOS</h2>
            <a href="/PyMEstock/assets/php/productos.php"><img src="/PyMEstock/assets/img/productos.jpg" alt="Productos"></a>
        </section>
        <section class="section section-clientes">
            <h2>CLIENTES</h2>
            <a href="/PyMEstock/assets/php/clientes.php"><img src="/PyMEstock/assets/img/clientes.jpeg" alt="Clientes"></a>
        </section>
        <section class="section section-proveedores">
            <h2>PROVEEDORES</h2>
            <a href="/PyMEstock/assets/php/proveedores.php"><img src="/PyMEstock/assets/img/proveedores.jpeg" alt="Proveedores"></a>
        </section>
        <section class="section section-ventas">
            <h2>VENTAS</h2>
            <a href="/PyMEstock/assets/php/ventas.php"><img src="/PyMEstock/assets/img/ventas.jpeg" alt="Ventas"></a>
        </section>
        <section class="section section-compras">
            <h2>COMPRAS</h2>
            <a href="/PyMEstock/assets/php/compras.php"><img src="/PyMEstock/assets/img/compras.jpeg" alt="Compras"></a>
        </section>
        <section class="section section-reportes">
            <h2>REPORTES</h2>
            <a href="/PyMEstock/assets/php/reportes.php"><img src="/PyMEstock/assets/img/reportes.jpeg" alt="Reportes"></a>
        </section>

        <section class="section expandable section-quienes-somos" onclick="mostrarMensaje(`
            <div class='alert-content'>
                <strong>¿QUIÉNES SOMOS?</strong><br><br>
                <strong>Misión:</strong><br>Nuestra misión es proporcionar a las PYMEs una solución integral y accesible para la gestión de inventario, ayudándoles a optimizar sus procesos y aumentar su rentabilidad.<br><br>
                <strong>Visión:</strong><br>Nuestra visión es ser el proveedor líder de software de gestión de inventario para PYMEs, reconocido por nuestra calidad y compromiso con la excelencia.<br><br>
                <strong>Valores:</strong><br>Nuestros valores incluyen la innovación, la integridad, la colaboración y el servicio al cliente.<br><br>
                <strong>Dirección:</strong><br>Estamos ubicados en la <a href='https://www.google.com/maps/place/Universidad+Tecnol%C3%B3gica+Del+Per%C3%BA/@-6.0585585,-81.2462055,8z/data=!4m10!1m2!2m1!1sutp!3m6!1s0x904ceee4d53c16e7:0x421be55c99eef623!8m2!3d-6.7637954!4d-79.8634243!15sCgN1dHAiA4gBAZIBF2VkdWNhdGlvbmFsX2luc3RpdHV0aW9u4AEA!16s%2Fg%2F12hkbrgz_?entry=ttupara'>Av. Principal 123</a>, en la ciudad de Ejemplo.<br><br>
                <strong>Horario:</strong><br>Nuestro horario de atención es de lunes a viernes de 8:00 a.m. a 5:00 p.m. Siempre estamos disponibles por correo electrónico y teléfono para atender cualquier consulta.
            </div>`
        );">
            <h2>¿QUIÉNES SOMOS?</h2>
            <div class="content">
            Easy-PyMEstock ofrece una amplia gama de servicios para la gestión de inventario, incluyendo seguimiento de stock, gestión de proveedores, control de ventas y generación de informes.
            </div>
        </section>
        <section class="section expandable section-resena-historica" onclick="mostrarMensaje('Easy-PyMEstock nació en el año 2024 y está formado por un equipo de profesionales altamente capacitados y comprometidos con la excelencia en el servicio al cliente .- Con pocos meses de experiencia en el mercado, Easy-PyMEstock se ha posicionado como líder en el sector de software de gestión de inventario para PYMEs.');">
            <h2>RESEÑA HISTÓRICA</h2>
            <div class="content">
            Easy-PyMEstock está formado por un equipo de profesionales altamente capacitados y comprometidos con la excelencia en el servicio al cliente.
            </div>
        </section>
    </main>

    <!-- Ventana emergente -->
    <div id="alertBox" class="alert-box">
        <div id="alertContent" class="alert-content"></div>
        <div class="alert-buttons">
            <button onclick="cerrarAlerta()">Cerrar</button>
        </div>
    </div>

    <footer>
        <h2>CONTÁCTANOS</h2>
        <ul class="contact-links">
            <li><a href="https://facebook.com/easypymestock" target="_blank"><img src="/PyMEstock/assets/icon/facebook.ico" alt="Facebook"></a></li>
            <li><a href="https://wa.me/940931704" target="_blank"><img src="/PyMEstock/assets/icon/whatsapp.ico" alt="WhatsApp"></a></li>
            <li><a href="https://tiktok.com/easypymestock" target="_blank"><img src="/PyMEstock/assets/icon/tiktok.ico" alt="TikTok"></a></li>
            <li><a href="https://instagram.com/easypymestock" target="_blank"><img src="/PyMEstock/assets/icon/instagram.ico" alt="Instagram"></a></li>
            <li><a href="mailto:info@easypymestock.com"><img src="/PyMEstock/assets/icon/gmail.ico" alt="Email"></a></li>
        </ul>
    </footer>
</body>
</html>

