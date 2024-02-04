<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 

  $reserva    = $_POST['rese'];
  $anterior   = $_POST['ante'];
  $usuario    = $_POST['usuario'];
  $observacion =  $anterior.' '.strtoupper($_POST['obse']).' Usuario :'.$usuario.' Fecha :'.date('Y-m-d H:i:s').'';

  $update = $hotel->adicionaObservaciones($reserva,$observacion);

  echo $update;

?>
