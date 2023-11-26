<?php 

require '../../../res/php/app_topHotel.php'; 

$huespedes = $hotel->getPerfilHuespedes();

foreach ($huespedes as $huesped) {
  $id = $huesped['id_huesped'];
  $nac = $huesped['fecha_nacimiento'];
  // $ven = $factura['fecha_vencimiento'];

  $edad = number_format((strtotime(FECHA_PMS) - strtotime($nac)) / (60*60*24*365),0) ; 
  
  if($dias <= 0){
    $dias = 0;
  }

  echo $edad.'<br>';

  $regis = $hotel->asignaEdad($id, $edad);
   


  // echo $regis;

} 






