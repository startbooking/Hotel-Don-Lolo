<?php 
  require '../../../res/php/app_topHotel.php'; 

  $ciudad = $_POST['ciudad']; 

  $municipio  = $hotel->traeCiudadHuesped($ciudad);

 
  echo json_encode($municipio);
