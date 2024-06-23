<?php 
  require '../../../res/php/app_topHotel.php'; 

  extract($_POST);
  $huesped = $hotel->buscaHuespedHueped($ident, $id);

	echo json_encode($huesped);

 ?>
