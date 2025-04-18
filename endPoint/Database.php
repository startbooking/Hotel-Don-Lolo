<?php
/**
 * Clase para manejar la conexión a la base de datos
 */

// Prevenir acceso directo al archivo
if (!defined('SECURE_ACCESS')) {
    header('HTTP/1.0 403 Forbidden');
    exit('Acceso prohibido');
}

class Database {
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $conn;
    
    /**
     * Constructor de la clase
     */
    public function __construct() {
        $this->host = DB_HOST;
        $this->dbName = DB_NAME;
        $this->username = DB_USER;
        $this->password = DB_PASS;
    }
    
    /**
     * Establece y devuelve una conexión a la base de datos
     * 
     * @return PDO Objeto de conexión a la base de datos
     * @throws PDOException Si ocurre un error en la conexión
     */
    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbName};charset=utf8",
                    $this->username,
                    $this->password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );
            } catch (PDOException $e) {
                // Registrar el error pero no mostrar detalles sensibles
                error_log('Error de conexión a la base de datos: ' . $e->getMessage());
                throw new Exception('Error al conectar con la base de datos');
            }
        }
        
        return $this->conn;
    }
    
    /**
     * Cierra la conexión a la base de datos
     */
    public function closeConnection() {
        $this->conn = null;
    }
}
?>
