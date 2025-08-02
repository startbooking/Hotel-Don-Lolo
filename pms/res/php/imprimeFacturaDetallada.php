<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$infoFactura = $hotel->traeInfoFactura($factura);
$infoFE = $hotel->traeInfoFE($factura);

$QRStr = $infoFE[0]['QRStr'];
$cufe = $infoFE[0]['cufe'];
$timeCreated = $infoFE[0]['timeCreated'];

$eToken = $hotel->datosTokenCia();
$token = $eToken[0]['token'];
$password = $eToken[0]['password'];
$facturador = $eToken[0]['facturador'];

$estadofactura = [];
$refer = $infoFactura[0]['referencia_cargo'];
$detalle = $infoFactura[0]['informacion_cargo'];
$usuario = $infoFactura[0]['usuario_factura'];

$canti = 1;

$codigo = $infoFactura[0]['id_codigo_cargo'];
$tipofac = $infoFactura[0]['tipo_factura'];
$reteiva = $infoFactura[0]['reteiva'];
$reteica = $infoFactura[0]['reteica'];
$retefuente = $infoFactura[0]['retefuente'];
$baseIva = $infoFactura[0]['basereteiva'];
$baseIca = $infoFactura[0]['basereteica'];
$baseRete = $infoFactura[0]['baseretefuente'];
$idhuesped = $infoFactura[0]['id_huesped'];
$idPerfil = $infoFactura[0]['id_perfil_factura'];
$reserva = $infoFactura[0]['numero_reserva'];
$horaFact = substr($infoFactura[0]['fecha_sistema_cargo'], 11, 8);
$folioAct = $infoFactura[0]['folio_cargo'];

$resFac = $hotel->getResolucion(1);
$resolucion = $resFac['resolucion'];
$prefijo = $resFac['prefijo'];
$fechaRes = $resFac['fecha'];
$desde = $resFac['desde'];
$hasta = $resFac['hasta'];

$fechaFac = $infoFactura[0]['fecha_salida'];
$fechaVen = $infoFactura[0]['fecha_vencimiento'];
$diasCre = 0;
$paganticipo = 0;
$totalSinImpto = 0;
$valorRet = [];

if ($tipofac == 1) {
  $id = $idhuesped;
} else {
  $id = $idPerfil;
  $datosCompania = $hotel->getSeleccionaCompania($id);
  $diasCre = $datosCompania[0]['dias_credito'];
  $aplicarete = $datosCompania[0]['retefuente'];
  $aplicaiva  = $datosCompania[0]['reteiva'];
  $aplicaica  = $datosCompania[0]['reteica'];
  $sinBaseRete  = $datosCompania[0]['sinBaseRete'];

  if ($aplicarete == 1) {
    if ($sinBaseRete == 1) {
      $valorRet = $hotel->traeValorRetencionesSinBase($reserva, $folioAct);
    } else {
      $valorRet = $hotel->traeValorRetenciones($reserva, $folioAct);
    }
  }
}

$retIva = $hotel->traeRetenciones(2);
$retIca = $hotel->traeRetenciones(3);

$porceReteiva = $retIva[0]['porcentajeRetencion'];
$porceReteica = $retIca[0]['porcentajeRetencion'];

$idperfil = $id;

$filename = '../../../img/pms/QR_'.$prefijo.'-'.$factura.'.png';
$datosReserva = $hotel->getReservasDatos($reserva);
$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);

$horaIng = $datosReserva['hora_llegada'];

if ($tipofac == 2) { 
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
}

$textoResol = 'RESOLUCION DIAN No.'.$resolucion.' de '.$fechaRes.' Autorizacion Pref '.$prefijo.' desde el No. '.$desde.' AL '.$hasta;

$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
$fechaVen = date('Y-m-d', $fechaVen);

$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva['tipo_habitacion']);
$folios = $hotel->getFacturaDetallada($factura, $reserva, $folioAct, 1);
$pagosfolio = $hotel->getFacturaDetallada($factura, $reserva, $folioAct, 3);
$tipoimptos = $hotel->getValorImptoFolio($factura, $reserva, $folioAct, 2);
$fecha = $hotel->getDatePms();

if($datosReserva['fecha_salida']> FECHA_PMS){
    $fechaSalida = FECHA_PMS;
}else{
    $fechaSalida = $datosReserva['fecha_salida'];
}

include_once '../../imprimir/imprimeQR.php';
include_once '../../imprimir/imprimeFacturaDetallada.php';

$envio = [
  "impresion" => $base64Factura
]; 

echo json_encode($envio);
