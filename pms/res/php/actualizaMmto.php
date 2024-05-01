<?php 
  require_once '../../../res/php/app_topHotel.php'; 
  $idmmto =  $_POST['idmmto'];
  $hasta  =  $_POST['hasta'];

	$update = $hotel->actualizaMmto($idmmto, $hasta);

  echo $update;
