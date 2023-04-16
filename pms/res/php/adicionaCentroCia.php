<?php 
  require_once '../../../res/php/app_topHotel.php'; 
  $nombre      =  strtoupper($_POST['nombre']);
  $responsable =  strtoupper($_POST['responsable']);
  $idCia       =  $_POST['idCia'];

	$adiciona = $hotel->insertaCentrosCia($nombre, $responsable, $idCia);

  echo $adiciona;
