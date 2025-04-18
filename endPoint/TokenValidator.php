<?php
/**
 * Clase para validar tokens de autenticación
 * 
 * Esta clase proporciona métodos para validar tanto tokens personalizados
 * almacenados en la base de datos como tokens JWT.
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Acceso prohibido');
}

class TokenValidator {
    private $conn;
    private $useJwt;
    
    /**
     * Constructor de la clase
     * 
     * @param PDO $conn Conexión a la base de datos
     * @param bool $useJwt Indica si se utilizan tokens JWT (true) o tokens personalizados (false)
     */
    public function __construct($conn, $useJwt = false) {
        $this->conn = $conn;
        $this->useJwt = $useJwt;
    }
    
    /**
     * Valida un token de autenticación
     * 
     * @param string $token Token a validar
     * @return array|bool Información del token si es válido, false en caso contrario
     */
    public function validate($token) {
        if ($this->useJwt) {
            return $this->validateJwtToken($token);
        } else {
            return $this->validateDatabaseToken($token);
        }
    }
    
    /**
     * Valida un token almacenado en la base de datos
     * 
     * @param string $token Token a validar
     * @return array|bool Información del token si es válido, false en caso contrario
     */
    private function validateDatabaseToken($token) {
        // Sanitizar el token para prevenir inyección SQL
        $token = filter_var($token, FILTER_SANITIZE_STRING);
        
        // Consultar el token en la base de datos
        $query = "SELECT t.id, t.user_id, t.created_at, t.expires_at 
                 FROM tokens t 
                 WHERE t.token = :token 
                 AND t.expires_at > NOW() 
                 AND t.is_revoked = 0";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch();
            }
            
            return false;
        } catch (PDOException $e) {
            error_log('Error al validar token en base de datos: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Valida un token JWT
     * 
     * @param string $token Token JWT a validar
     * @return array|bool Información del token si es válido, false en caso contrario
     */
    private function validateJwtToken($token) {
        // Implementación básica de validación JWT
        // En un entorno de producción, se recomienda usar una biblioteca como firebase/php-jwt
        
        $tokenParts = explode('.', $token);
        
        // Verificar formato del token
        if (count($tokenParts) !== 3) {
            return false;
        }
        
        list($header, $payload, $signature) = $tokenParts;
        
        // Decodificar payload
        $payloadDecoded = json_decode(base64_decode($payload), true);
        
        // Verificar si el token ha expirado
        if (!isset($payloadDecoded['exp']) || $payloadDecoded['exp'] < time()) {
            return false;
        }
        
        // Verificar firma (implementación simplificada)
        $expectedSignature = hash_hmac(
            'sha256', 
            "$header.$payload", 
            JWT_SECRET, 
            true
        );
        $expectedSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($expectedSignature));
        
        if ($signature !== $expectedSignature) {
            return false;
        }
        
        // Si llegamos aquí, el token es válido
        return [
            'user_id' => $payloadDecoded['sub'],
            'created_at' => date('Y-m-d H:i:s', $payloadDecoded['iat']),
            'expires_at' => date('Y-m-d H:i:s', $payloadDecoded['exp'])
        ];
    }
    
    /**
     * Registra un intento fallido de validación de token
     * 
     * @param string $token Token que falló la validación
     * @param string $ip Dirección IP desde donde se intentó
     */
    public function logFailedAttempt($token, $ip) {
        // Implementar registro de intentos fallidos para detectar posibles ataques
        $query = "INSERT INTO token_failed_attempts (token, ip_address, attempt_time) 
                 VALUES (:token, :ip, NOW())";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error al registrar intento fallido: ' . $e->getMessage());
        }
    }
}
?>
