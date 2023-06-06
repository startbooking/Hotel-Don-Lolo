<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php'; 
  
  $tarifa =  $_POST['tarifa'];
  $tipo   =  $_POST['tipo'];
  $hom    =  $_POST['hom'];
  $muj    =  $_POST['muj'];
  $nin    =  $_POST['nin'];

  $valortarifa = $hotel->getValorTarifa($tarifa);

  $adultos = $hom + $muj;
  switch ($adultos) {
    case 0:
      $valortar = 0;
      break;
    case 1:
      $valortar = $valortarifa[0]['valor_un_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 2:
      $valortar = $valortarifa[0]['valor_dos_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 3:
      $valortar = $valortarifa[0]['valor_tre_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 4:
      $valortar = $valortarifa[0]['valor_cua_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 5:
      $valortar = $valortarifa[0]['valor_cin_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 6:
      $valortar = $valortarifa[0]['valor_sei_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 7:
      $valortar = $valortarifa[0]['valor_sie_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 8:
      $valortar = $valortarifa[0]['valor_och_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 9:
      $valortar = $valortarifa[0]['valor_nue_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    case 10:
      $valortar = $valortarifa[0]['valor_die_pax'] + ($valortarifa[0]['valor_nino'] * $nin);
      break;
    default:
      $valortar = ($valortarifa[0]['valor_adicional'] * $adultos) + ($valortarifa[0]['valor_nino'] * $nin);
      break;
  }

  echo $valortar;

  ?>