<?php

require '../../../res/php/app_topAdmin.php';
$data = json_decode(file_get_contents('php://input'), true);
extract($data);

$regis = $admin->insertResolucion(strtoupper($nombre), $desde, $hasta, strtoupper($prefijo), $fecha, $tipo, $vigencia) ; 
echo json_encode($regis) ;
