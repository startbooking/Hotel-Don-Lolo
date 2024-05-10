<?php
require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$cargos = $hotel->actualizaCargosFacturas($factura, $perfil);
$anula = $hotel->anulaFactura($factura, 'FACTURA NO PROCESADA POR LA DIAN', $usuario, $idusuario, $perfil, 0);
// $regis = $hotel->ingresaNCFactura($numero, $motivo, $idusuario, $numDoc, FECHA_PMS);
// $entra = $hotel->updateEstadoReserva($reserva); 
 
echo $anula;