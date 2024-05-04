<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $huespedes = $hotel->getPerfilHuespedes();

  foreach ($huespedes as $huesped) {
		$id      = $huesped['id_huesped'];
		$nombres = $huesped['apellido1'].' '.$huesped['apellido2'].' '.$huesped['nombre1'].' '.$huesped['nombre2'];
		$actua   = $hotel->actualizaNombre($id,$nombres);
  }

  echo $actua;

?>