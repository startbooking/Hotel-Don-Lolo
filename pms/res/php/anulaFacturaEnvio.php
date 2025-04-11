<?php
require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$cargos = $hotel->actualizaCargosFacturas($factura, $perfil);
$anula = $hotel->anulaFactura($factura, 'FACTURA NO PROCESADA POR LA DIAN', $usuario, $usuario_id, $perfil, 0);

$siFE = $hotel->consultaDatosFE($factura);

if($siFE == 1){
  $regis = $hotel->actualizaFE($factura);
}else {
  $regis = $hotel->ingresaFE($factura);
}

$regis = $hotel->actualizaEstadoReserva($reserva);



echo $anula;