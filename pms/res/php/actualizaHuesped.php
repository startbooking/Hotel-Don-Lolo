<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $huespedes = $hotel->getPerfilHuespedes();

  foreach ($huespedes as $huesped) {
		$id      = $huesped['id_huesped'];
		$nombres = trim($huesped['apellido1']).' '.trim($huesped['apellido2']).' '.trim($huesped['nombre1']).' '.trim($huesped['nombre2']);
		$actua   = $hotel->actualizaNombre($id,$nombres);
  }

  // echo $actua;
  echo 'Proceso Terminado con exito';

?>