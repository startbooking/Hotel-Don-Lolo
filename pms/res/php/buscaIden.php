<?php 

  require '../../../res/php/app_topHotel.php'; 
  $iden  =  $_POST['iden'];

  $huesped = $hotel->getbuscaIden($iden);

  echo json_encode($huesped);

?>