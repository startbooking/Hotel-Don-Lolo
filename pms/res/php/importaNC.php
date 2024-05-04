<?php 

  require '../../../res/php/app_topHotel.php'; 

  $notas = $hotel->traeNotas();


foreach ($notas as $nota) {

  $enviado =  json_decode($nota['jsonEnviado'], true);

  $factura = $enviado['billing_reference']['number'];
  
  $fecha = $enviado['date'];
  $motivo = $enviado['discrepancyresponsedescription'];
  $numero = $enviado['number'];

  $user = $hotel->traeUsuarioNC($factura);

  $regis = $hotel->ingresaNCImport($factura, $fecha, $motivo, $numero, $user);

  echo $regis;

} 
