<?php 
  require_once '../../../res/php/app_topHotel.php'; 
  $nombre      =  strtoupper($_POST['nombre']);
  $responsable =  strtoupper($_POST['responsable']);
  $idCentro       =  $_POST['idCentro'];

	$update = $hotel->updateCentrosCia($nombre, $responsable, $idCentro);

  echo $update;
