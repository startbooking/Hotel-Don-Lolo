<?php 

require '../../../res/php/app_topHotel.php'; 

$facturas = $hotel->traeFacturasFecha();

foreach ($facturas as $factura) {
  $id = $factura['id_cargo'];
  $fac = $factura['fecha_factura'];
  $ven = $factura['fecha_vencimiento'];

  $dias = (strtotime($ven) - strtotime($fac)) / (60*60*24) ; 
  
  if($dias <= 0){
    $dias = 0;
  }

  echo $dias.'<br>';

  $regis = $hotel->asignaDiasCredito($id, $dias);
   

  //echo date("d-m-Y",strtotime($fecha_actual."+ 1 days")); 
  //resto 1 día
 // echo date("d-m-Y",strtotime($fecha_actual."- 1 days")); 



  // echo $regis;

} 






