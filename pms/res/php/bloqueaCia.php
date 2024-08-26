<?php 
  require_once '../../../res/php/app_topHotel.php'; 
  $cia    =  $_POST['cia'];
  $estado =  $_POST['estado'];
  $cambia = 0;

  if($estado==0){
    $cambia = 1;
  }

	$bloquea = $hotel->bloqueaCia($cia, $cambia);

  echo $bloquea;
