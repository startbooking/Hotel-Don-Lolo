<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);


$regis = $hotel->insertaNuevoHuesped($identifica, $tipodoc, strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), $sexOption, strtoupper($direccion), $telefono, $celular, strtolower($correo), $fechanace, $paices, $ciudadHue, $paisExp, $ciudadExp, $usuario, $usuario_id, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $empresa, $profesion, $edad);

$accion = 'ADICIONA HUESPED';
$inicial = 'Huesped ' . $identifica . ' ' . $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2;
$final = '';

$log = $hotel->ingresoLog($regis, $usuario, $pc, $ip, $accion, $inicial, $final, 'HU');

echo json_encode($regis);
 