<?php 

require '../../../res/php/app_topHotel.php'; 

$huespedes = $hotel->traeHuespedes();

$search = ",";
$replace = " ";

foreach ($huespedes as $huesped) {
  $id = $huesped['id_huesped'];
  $dir = $huesped['direccion'];
  
  if($dir!=''){
    $resultado = str_ireplace($search, $replace, $dir);
    $regis = $hotel->actualizaDireccion($id, $resultado);
  }

  echo $regis;

} 
