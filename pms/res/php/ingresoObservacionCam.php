<?php 
  require '../../../res/php/app_topHotel.php';
  extract($_POST); 

  $ingresa = $hotel->ingresaObservacionCam($numeroRes,$numeroHab, $fechaObs, $reportadoPor, strtoupper($reporteObs), $usuario_id, $ocupada, $sucia);

  echo $ingresa;


?>
