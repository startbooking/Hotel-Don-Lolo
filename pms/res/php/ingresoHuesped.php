<?php

require '../../../res/php/app_topHotel.php';

extract($_POST);

$regis = $hotel->insertaNuevoHuesped($identifica, $tipodoc, strtoupper($apellido1), strtoupper($apellido2), strtoupper($nombre1), strtoupper($nombre2), $sexOption, strtoupper($direccion), $telefono, $celular, strtolower($correo), $fechanace, $pais, $ciudad, $paisExp, $ciudadExp, $usuario, $idusuario, $tipoAdquiriente, $tipoResponsabilidad, $responsabilidadTribu, $empresa, $profesion);

$accion = 'ADICIONA HUESPED';
$id = $idusuario;
$inicial = 'Huesped ' . $iden . ' ' . $apellido1 . ' ' . $apellido2 . ' ' . $nombre1 . ' ' . $nombre2;
$final = '';

$log = $hotel->ingresoLog($regis, $usuario, $pc, $ip, $accion, $inicial, $final, 'HU');

echo $regis;
