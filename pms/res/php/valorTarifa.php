<?php 

  require '../../../res/php/titles.php';
  require '../../../res/php/app_topHotel.php';

  extract($_POST);

 $valor = $hotel->traeValorTarifa($tarifa, $tipo, $desde, $hasta);

  if(!isset($valor)){
    echo '-1';
    return ;
  }

  $adultos = $hom + $muj;
  switch ($adultos) {
    case 0:
      $valortar = 0;
      break;
    case 1:
      $valortar = $valor['valor_un_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 2:
      $valortar = $valor['valor_dos_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 3:
      $valortar = $valor['valor_tre_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 4:
      $valortar = $valor['valor_cua_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 5:
      $valortar = $valor['valor_cin_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 6:
      $valortar = $valor['valor_sei_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 7:
      $valortar = $valor['valor_sie_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 8:
      $valortar = $valor['valor_och_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 9:
      $valortar = $valor['valor_nue_pax'] + ($valor['valor_nino'] * $nin);
      break;
    case 10:
      $valortar = $valor['valor_die_pax'] + ($valor['valor_nino'] * $nin);
      break;
    default:
      $valortar = ($valor['valor_adicional'] * $adultos) + ($valor['valor_nino'] * $nin);
      break;
  }

  echo $valortar;

  ?>