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
    'charset' => 'utf8',
    'error' => PDO::ERRMODE_WARNING,
  ]);
} catch (PDOException $e) {
    echo 'No se pudo Conectar a la Base de Datos';
}
