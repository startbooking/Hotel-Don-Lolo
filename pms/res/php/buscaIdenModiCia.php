<?php 
  require '../../../res/php/app_topHotel.php'; 

  extract($_POST);
  $cia = $hotel->buscaNitCia($ident, $id);

	echo json_encode($cia);

 ?>
