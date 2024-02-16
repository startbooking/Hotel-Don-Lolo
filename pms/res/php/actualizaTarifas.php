<?php 

  require '../../../res/php/app_topHotel.php'; 

  $tarifas = $hotel->traeTarifas();

$uno = 0;
$dos = 0;
$tre = 0;
$cua = 0;
$cin = 0;
$sei = 0;
$adi = 0;
$nin = 0;
$inc= 19;

foreach ($tarifas as $tarifa) {
  $id = $tarifa['id'];
  $uno = round($tarifa['valor_un_pax']*(1.19),0);
  $dos = round($tarifa['valor_dos_pax']*(1.19),0);
  $tre = round($tarifa['valor_tre_pax']*(1.19),0);
  $cua = round($tarifa['valor_cua_pax']*(1.19),0);
  $cin = round($tarifa['valor_cin_pax']*(1.19),0);
  $sei = round($tarifa['valor_sei_pax']*(1.19),0);
  $adi = round($tarifa['valor_adicional']*(1.19),0);
  $nin = round($tarifa['valor_nino']*(1.19),0);
  
  // echo $id.'-'.$uno.'-'.$dos.'-'.$tre.'-'.$cua.'-'.$cin.'-'.$sei.'-'.$adi.'-'.$nin.'<br>' ;


  $regis = $hotel->actualizaTarifa($id, $uno, $dos, $tre, $cua, $cin, $sei, $adi, $nin);
 
} 
