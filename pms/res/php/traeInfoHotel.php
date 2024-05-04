<?php 
  require '../../../res/php/app_topHotel.php'; 

  $municipio  = $hotel->traeInfoHotel();

  echo json_encode($municipio);
