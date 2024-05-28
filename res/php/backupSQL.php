<?php
// Configuración de la conexión a la base de datos MySQL
/* $host = 'localhost';
$user = $_GET['user'];
$password = $_GET['password'];
$database = $_GET['database'];

$dbtype = 'mysql';
$host = 'localhost';
$server = 'localhost';
$dbuser = 'root';
$dbpass = 'b4r4h0n4';
$dbname = 'donloloMayo25'; 
 
 

*/
include_once 'configdb.pgp'
// Realizar la conexión a la base de datos
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
if ($conn->connect_error) {
    die('Error de conexión: ' . $conn->connect_error);
}

// Obtener el volcado de la base de datos
$tables = array();
$result = $conn->query('SHOW TABLES');
while ($row = $result->fetch_row()) {
    $tables[] = $row[0];
}

$backup = '';
foreach ($tables as $table) {
    $result = $conn->query('SELECT * FROM ' . $table);
    $num_fields = $result->field_count;

    $backup .= 'DROP TABLE IF EXISTS `' . $table . '`;';
    $row2 = $conn->query('SHOW CREATE TABLE ' . $table)->fetch_row();
    $backup .= "\n\n" . $row2[1] . ";\n\n";

    for ($i = 0; $i < $num_fields; $i++) {
        while ($row = $result->fetch_row()) {
            $backup .= 'INSERT INTO `' . $table . '` VALUES(';
            for ($j = 0; $j < $num_fields; $j++) {
                $row[$j] = addslashes($row[$j]);
                $row[$j] = preg_replace("/\n/", "\\n", $row[$j]);
                if (isset($row[$j])) {
                    $backup .= '"' . $row[$j] . '"';
                } else {
                    $backup .= '""';
                }
                if ($j < ($num_fields - 1)) {
                    $backup .= ',';
                }
            }
            $backup .= ");\n";
        }
    }
    $backup .= "\n\n\n";
}

// Establecer el tipo de contenido y enviar el backup
header('Content-Type: text/plain');
echo $backup;
