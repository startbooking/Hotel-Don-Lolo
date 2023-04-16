<?php 
  require_once '../../../res/php/app_topHotel.php'; 
  $idCentro       =  $_POST['idCentro'];


	$elimina = $hotel->eliminaCentrosCia($idCentro);

  echo $elimina;
