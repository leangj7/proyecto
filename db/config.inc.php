<?php
define('NOMBRE_SERVIDOR', '');
define('NOMBRE_USUARIO', '');
define('CLAVE', '');
define('NOMBRE_BD', '');

// Rutas de la web
define("SERVIDOR", "http://");
define("RUTA_REGISTRO", SERVIDOR . "/registro");
define("RUTA_REGISTRO_CORRECTO", SERVIDOR . "/gracias-por-registrarte");
define("RUTA_REGISTRO_INCORRECTO", SERVIDOR . "/error-registro");
define("RUTA_INICIO_SESION", SERVIDOR . "/ingresar");
define("RUTA_CERRAR_SESION", SERVIDOR . "/salir");
define("RUTA_INFO", SERVIDOR . "/informacion");

// Paginas de inicio
define("RUTA_INICIO", SERVIDOR . "/inicio");
define("RUTA_ACERCA_DE", SERVIDOR . "/acerca-de");
define("RUTA_FAQ", SERVIDOR . "/faq");
define("RUTA_CONTACTO", SERVIDOR . "/contacto");
define("RUTA_RESULTADOS", SERVIDOR . "/resultados");

// Paginas de perfil
define("RUTA_PERFIL", SERVIDOR . "/perfil");
// Código eliminado
define("RUTA_CAMBIAR_CLAVE", SERVIDOR . "/cambiar-clave");
define("RUTA_ELIMINAR_CUENTA", SERVIDOR . "/eliminar-cuenta");
define("RUTA_MODIFICAR_PERFIL", SERVIDOR . "/modificar-perfil");

// Recuperar contraseña
define("RUTA_RECUPERAR_CLAVE", SERVIDOR . "/recuperar-clave");
define("RUTA_NUEVA_CLAVE", SERVIDOR . "/nueva-clave");
define("RUTA_CLAVE_CORRECTA", SERVIDOR . "/clave-correcta");

// Estilos / Javascript / Imagenes
define("RUTA_CSS", SERVIDOR . "/css/");
define("RUTA_JS", SERVIDOR . "/js/");
define("RUTA_IMG", SERVIDOR . "/img/");

// Sistema de carpetas
define("DIRECTORIO_RAIZ", realpath(__DIR__ . "/.."));