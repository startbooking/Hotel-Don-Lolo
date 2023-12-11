<?php 
  require '../../../res/php/app_topHotel.php'; 
	
  $id      = $_POST['id'];

  $tarifa = $hotel->getNombreTarifa($id);

  echo $tarifa;

?>
