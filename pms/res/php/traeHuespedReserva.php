<?php 
  require '../../../res/php/app_topHotel.php'; 

  $reserva = $_POST['reserva']; 
  $fecha = $_POST['fecha']; 

  $huesped  = $hotel->HuespedllegadaDelDiaTRA($reserva,$fecha,'CA');

 
  echo json_encode($huesped);
