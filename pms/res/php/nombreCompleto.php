<?php 

echo 'Entro ';

require '../../../res/php/app_topHotel.php'; 

$huespedes = $hotel->huespedesSinNombreCompleto();

// echo print_r($huespedes);

foreach ($huespedes as $huesped) {
  $ape = $huesped['apellido1'];
  $nom = $huesped['nombre1'];
  $id =  $huesped['id_huesped'];
  $resultado = $ape.' '.$nom;
  $regis = $hotel->actualizaHuespedessinNombreCompleto($id, $resultado);
  
  echo $regis;

} 
