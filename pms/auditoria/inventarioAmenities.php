<?php 

$inv = $hotel->getInventarioHotel();

if($inv[0]['inventario_amenities']!=0){

  $ocupadas = $hotel->getTipoHabitacionesOcupadas();
  
  
  if(count($ocupadas)==0){
    return 0 ;
  }
  
  foreach ($ocupadas as $key => $value) {
    $productos = $hotel->getProductosAmenities($value['tipo_habitacion']);

    echo print_r($productos);

  }
}


?>
