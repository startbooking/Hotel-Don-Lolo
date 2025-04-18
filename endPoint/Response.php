<?php
/**
 * Clase para formatear respuestas JSON
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Acceso prohibido');
}

class Response {
    /**
     * Envía una respuesta de éxito
     * 
     * @param mixed $data Datos a incluir en la respuesta
     * @param int $statusCode Código de estado HTTP (por defecto 200)
     */
    public static function success($data, $statusCode = 200) {
        self::send([
            'status' => 'success',
            'data' => $data
        ], $statusCode);
    }
    
    /**
     * Envía una respuesta de error
     * 
     * @param int $statusCode Código de estado HTTP
     * @param string $message Mensaje de error
     * @param array $details Detalles adicionales del error (opcional)
     */
    public static function error($statusCode, $message, $details = []) {
        $response = [
            'status' => 'error',
            'message' => $message
        ];
        
        // Agregar detalles solo si no estamos en producción o si DEBUG_MODE está activado
        if (DEBUG_MODE && !empty($details)) {
            $response['details'] = $details;
        }
        
        self::send($response, $statusCode);
    }
    
    /**
     * Envía una respuesta JSON
     * 
     * @param array $data Datos a enviar
     * @param int $statusCode Código de estado HTTP
     */
    private static function send($data, $statusCode) {
        // Establecer código de estado HTTP
        http_response_code($statusCode);
        
        // Agregar timestamp a la respuesta
        $data['timestamp'] = date('Y-m-d H:i:s');
        
        // Convertir a JSON y enviar
        echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        exit;
    }
}
?>
