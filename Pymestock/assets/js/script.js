document.addEventListener("DOMContentLoaded", function() {
    // Ejecutando funciones al cargar la página
    document.getElementById("btn__iniciar-sesion").addEventListener("click", iniciarSesion);
    document.getElementById("btn__registrarse").addEventListener("click", Registro);
    
    // Ajustar el diseño inicial en función del tamaño de la pantalla
    window.addEventListener("resize", ajustarVisualizacion);
    ajustarVisualizacion();
});

// Declarando variables globales
var formulario_login = document.querySelector(".formulario__login");
var formulario_register = document.querySelector(".formulario__register");
var contenedor_login_register = document.querySelector(".contenedor__login-register");
var caja_trasera_login = document.querySelector(".caja__trasera-login");
var caja_trasera_register = document.querySelector(".caja__trasera-register");

// Función para ajustar la visualización según el tamaño de la pantalla
function ajustarVisualizacion() {
    if (window.innerWidth > 850) {
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "block";
        formulario_register.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
    } else {
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        formulario_register.style.display = "none";
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
    }
}

// Función para mostrar el formulario de inicio de sesión
function iniciarSesion() {
    if (window.innerWidth > 850) {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "10px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.opacity = "1";
        caja_trasera_login.style.opacity = "0";
    } else {
        formulario_login.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_register.style.display = "none";
        caja_trasera_register.style.display = "block";
        caja_trasera_login.style.display = "none";
    }
}

// Función para mostrar el formulario de registro
function Registro() {
    if (window.innerWidth > 850) {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "410px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.opacity = "0";
        caja_trasera_login.style.opacity = "1";
    } else {
        formulario_register.style.display = "block";
        contenedor_login_register.style.left = "0px";
        formulario_login.style.display = "none";
        caja_trasera_register.style.display = "none";
        caja_trasera_login.style.display = "block";
        caja_trasera_login.style.opacity = "1";
    }

    // Agregar transición al contenedor
    contenedor_login_register.style.transition = "left 500ms cubic-bezier(0.175, 0.885, 0.32, 1.275)";
}

// Función para limitar la entrada en el campo N_Documento a 8 dígitos
document.getElementById("n_documento").addEventListener("input", function() {
    var maxLength = 8;
    var input = this;
    if (input.value.length > maxLength) {
        input.value = input.value.slice(0, maxLength);
    }

    // Mostrar mensaje de error si la longitud no es 8
    var errorSpan = document.getElementById("error_documento");
    if (input.value.length !== maxLength) {
        errorSpan.style.display = "inline";
    } else {
        errorSpan.style.display = "none";
    }
});

// Validación del número de documento al registrarse
document.querySelector(".formulario__register").addEventListener("submit", function(event) {
    var n_documento = document.getElementById("n_documento").value;
    if (n_documento.length !== 8 || isNaN(n_documento)) {
        alert("El número de documento debe tener exactamente 8 dígitos numéricos.");
        event.preventDefault(); // Evita que se envíe el formulario si la validación falla
    }
});

