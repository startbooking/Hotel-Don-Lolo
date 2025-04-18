<?php
/**
 * Clase para validar usuarios
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Acceso prohibido');
}

class UserValidator {
    private $conn;
    
    /**
     * Constructor de la clase
     * 
     * @param PDO $conn Conexión a la base de datos
     */
    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    /**
     * Valida un usuario
     * 
     * @param string $usuario Identificador del usuario (puede ser ID, nombre de usuario, etc.)
     * @return array|bool Información del usuario si es válido, false en caso contrario
     */
    public function validate($usuario) {
        // Determinar si el usuario es un ID numérico o un nombre de usuario
        if (is_numeric($usuario)) {
            return $this->validateById($usuario);
        } else {
            return $this->validateByUsername($usuario);
        }
    }
    
    /**
     * Valida un usuario por su ID
     * 
     * @param int $id ID del usuario
     * @return array|bool Información del usuario si es válido, false en caso contrario
     */
    private function validateById($id) {
        // Sanitizar el ID para prevenir inyección SQL
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        
        // Consultar el usuario en la base de datos
        $query = "SELECT id, username, email, status 
                 FROM users 
                 WHERE id = :id 
                 AND status = 'active'";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch();
            }
            
            return false;
        } catch (PDOException $e) {
            error_log('Error al validar usuario por ID: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Valida un usuario por su nombre de usuario
     * 
     * @param string $username Nombre de usuario
     * @return array|bool Información del usuario si es válido, false en caso contrario
     */
    private function validateByUsername($username) {
        // Sanitizar el nombre de usuario para prevenir inyección SQL
        $username = filter_var($username, FILTER_SANITIZE_STRING);
        
        // Consultar el usuario en la base de datos
        $query = "SELECT id, username, email, status 
                 FROM users 
                 WHERE username = :username 
                 AND status = 'active'";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                return $stmt->fetch();
            }
            
            return false;
        } catch (PDOException $e) {
            error_log('Error al validar usuario por nombre: ' . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Registra un intento fallido de validación de usuario
     * 
     * @param string $usuario Identificador del usuario que falló la validación
     * @param string $ip Dirección IP desde donde se intentó
     */
    public function logFailedAttempt($usuario, $ip) {
        // Implementar registro de intentos fallidos para detectar posibles ataques
        $query = "INSERT INTO user_failed_attempts (user_identifier, ip_address, attempt_time) 
                 VALUES (:usuario, :ip, NOW())";
        
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':ip', $ip);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log('Error al registrar intento fallido: ' . $e->getMessage());
        }
    }
}
?>
