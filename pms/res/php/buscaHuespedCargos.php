<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  $iden  =  $_POST['iden'];

  $huesped = $hotel->getbuscaHuesped($iden);

  echo $huesped;

?>