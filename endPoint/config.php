<?php
/**
 * Archivo de configuración
 * 
 * Contiene constantes y configuraciones para la aplicación
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Acceso prohibido');
}

// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_NAME', 'mi_plataforma');
define('DB_USER', 'usuario_db');
define('DB_PASS', 'contraseña_segura');

// Configuración de seguridad
define('TOKEN_EXPIRATION_TIME', 3600); // Tiempo de expiración del token en segundos (1 hora)
define('ALLOWED_ORIGIN', '*'); // En producción, especificar dominios permitidos

// Configuración de JWT (si se usa)
define('JWT_SECRET', 'clave_secreta_muy_larga_y_compleja'); // Cambiar en producción
define('JWT_ALGORITHM', 'HS256');

// Modo de depuración (desactivar en producción)
define('DEBUG_MODE', false);

// Configuración de zona horaria
date_default_timezone_set('America/Mexico_City'); // Ajustar según tu ubicación
?>
