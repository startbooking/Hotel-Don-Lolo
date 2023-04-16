<?php 

  require '../../../res/php/app_topHotel.php'; 
  $iden  =  $_POST['iden'];

  $compania = $hotel->getbuscaCompania($iden);

  echo json_encode($compania);

?>