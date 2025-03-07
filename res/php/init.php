<?php

include 'configdb.php';
require 'Medoo.php';
use Medoo\Medoo;

try {
  $database = new Medoo([
    'database_type' => $dbtype,
    'database_name' => $dbname,
    'server' => $server,
    'username' => $dbuser,
    'password' => $dbpass,
    'charset' => 'utf8mb4',
    'error' => PDO::ERRMODE_WARNING,
  	'option' => [
	  	// PDO::ATTR_CASE => PDO::FETCH_ASSOC
	  ],
  ]);
} catch (PDOException $e) {
    echo "error {$e->getMessage()} <br>";
    echo 'No se pudo Conectar a la Base de Datos';
}
