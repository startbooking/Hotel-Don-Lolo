<?php
/**
 * Endpoint API para consulta de información
 * 
 * Este archivo actúa como punto de entrada para el endpoint de consulta
 * y maneja la validación del token y usuario antes de proporcionar acceso
 * a la información solicitada.
 * 
 * @author v0
 * @version 1.0
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    define('SECURE_ACCESS', true);
}

// Incluir archivos necesarios
require_once 'config.php';
require_once 'Database.php';
require_once 'TokenValidator.php';
require_once 'UserValidator.php';
require_once 'Response.php';

// Configurar cabeceras para API REST
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: ' . ALLOWED_ORIGIN);
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Manejar solicitudes OPTIONS (para CORS)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Verificar método de solicitud (puedes ajustar según tus necesidades)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    Response::error(405, 'Método no permitido. Use POST para esta solicitud.');
    exit;
}

// Obtener datos de la solicitud
$inputData = json_decode(file_get_contents('php://input'), true);

// Si no hay datos JSON, intentar obtener de POST
if (empty($inputData)) {
    $inputData = $_POST;
}

// Validar parámetros requeridos
if (!isset($inputData['token']) || !isset($inputData['usuario'])) {
    Response::error(400, 'Parámetros incompletos. Se requiere token y usuario.');
    exit;
}

$token = $inputData['token'];
$usuario = $inputData['usuario'];

try {
    // Inicializar conexión a la base de datos
    $db = new Database();
    $conn = $db->getConnection();
    
    // Validar token
    $tokenValidator = new TokenValidator($conn);
    $tokenInfo = $tokenValidator->validate($token);
    
    if (!$tokenInfo) {
        Response::error(401, 'Token inválido o expirado.');
        exit;
    }
    
    // Validar usuario
    $userValidator = new UserValidator($conn);
    $userInfo = $userValidator->validate($usuario);
    
    if (!$userInfo) {
        Response::error(401, 'Usuario inválido.');
        exit;
    }
    
    // Verificar que el token pertenece al usuario
    if ($tokenInfo['user_id'] !== $userInfo['id']) {
        Response::error(403, 'El token no está asociado a este usuario.');
        exit;
    }
    
    // Procesar parámetros adicionales para la consulta
    $queryParams = [];
    
    // Ejemplo: Si se proporciona un ID de producto
    if (isset($inputData['id_producto'])) {
        $queryParams['id_producto'] = filter_var($inputData['id_producto'], FILTER_SANITIZE_NUMBER_INT);
    }
    
    // Ejemplo: Si se proporciona un rango de fechas
    if (isset($inputData['fecha_inicio']) && isset($inputData['fecha_fin'])) {
        $queryParams['fecha_inicio'] = filter_var($inputData['fecha_inicio'], FILTER_SANITIZE_STRING);
        $queryParams['fecha_fin'] = filter_var($inputData['fecha_fin'], FILTER_SANITIZE_STRING);
    }
    
    // Consultar la información solicitada
    $data = consultarInformacion($conn, $userInfo, $queryParams);
    
    // Devolver respuesta exitosa
    Response::success($data);
    
} catch (Exception $e) {
    // Log del error (en un entorno de producción, no mostrar detalles del error al cliente)
    error_log('Error en API: ' . $e->getMessage());
    
    // Respuesta genérica para el cliente
    Response::error(500, 'Error interno del servidor.');
}

/**
 * Consulta la información solicitada según los parámetros proporcionados
 * 
 * @param PDO $conn Conexión a la base de datos
 * @param array $userInfo Información del usuario validado
 * @param array $params Parámetros adicionales para la consulta
 * @return array Datos consultados
 */
function consultarInformacion($conn, $userInfo, $params) {
    // Esta función debe implementarse según la lógica específica de tu aplicación
    // Aquí hay un ejemplo básico:
    
    $userId = $userInfo['id'];
    $query = "SELECT * FROM informacion WHERE user_id = :user_id";
    $parameters = [':user_id' => $userId];
    
    // Agregar filtros adicionales según los parámetros
    if (isset($params['id_producto'])) {
        $query .= " AND id_producto = :id_producto";
        $parameters[':id_producto'] = $params['id_producto'];
    }
    
    if (isset($params['fecha_inicio']) && isset($params['fecha_fin'])) {
        $query .= " AND fecha BETWEEN :fecha_inicio AND :fecha_fin";
        $parameters[':fecha_inicio'] = $params['fecha_inicio'];
        $parameters[':fecha_fin'] = $params['fecha_fin'];
    }
    
    // Ejecutar consulta
    $stmt = $conn->prepare($query);
    $stmt->execute($parameters);
    
    // Devolver resultados
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
