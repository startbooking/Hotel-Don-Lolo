<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

$infoFactura = $hotel->traeInfoFactura($factura);

$eToken = $hotel->datosTokenCia();
$token = $eToken[0]['token'];
$password = $eToken[0]['password'];
$facturador = $eToken[0]['facturador'];

$estadofactura = [];
$refer = $infoFactura[0]['referencia_cargo'];
$detalle = $infoFactura[0]['informacion_cargo'];
$canti = 1;

$arcCurl = '../../json/recibeCurl' . $mes . $anio . '.json';
$envCurl = '../../json/enviaFact' . $mes . $anio . '.json';

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

$saldos = $hotel->getValorFactura($factura);
$anticipos = $hotel->valorAnticipos($factura);

if (count($anticipos) != 0) {
  $paganticipo = $anticipos[0]['pagos'];
}

if ($tipofac == 2) {
  $datosCompania = $hotel->getSeleccionaCompania($idPerfil);
  $diasCre = $datosCompania[0]['dias_credito'];
  $nomFact = $datosCompania[0]['empresa'];
  $nitFact = $datosCompania[0]['nit'];
  $dvFact = $datosCompania[0]['dv'];
  $emaFact = $datosCompania[0]['email'];
  $tdiFact = $datosCompania[0]['tipo_documento'];
  $triFact = $datosCompania[0]['tipoResponsabilidad'];

  $dirFact = $datosCompania[0]['direccion'];
  $merFact = '0000000-00';
  $torFact = $datosCompania[0]['tipoAdquiriente'];
  $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosCompania[0]['responsabilidadTributaria']);
  $munFact = $datosCompania[0]['ciudad'];
  $telFact = $datosCompania[0]['telefono'];
} else {
  $datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
  $nitFact = $datosHuesped[0]['identificacion'];
  $dvFact = '';
  $nomFact = $datosHuesped[0]['nombre1'] . ' ' . $datosHuesped[0]['nombre2'] . ' ' . $datosHuesped[0]['apellido1'] . ' ' . $datosHuesped[0]['apellido2'];
  $emaFact = $datosHuesped[0]['email'];
  $tdiFact = $datosHuesped[0]['tipo_identifica'];
  $triFact = $datosHuesped[0]['tipoResponsabilidad'];
}

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($factura, $reserva, $folioAct, 1);
// $pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($factura, $reserva, $folioAct, 3);
$tipoimptos = $hotel->getValorImptoFolio($factura, $reserva, $folioAct, 2);
$subtotales = $hotel->getConsumosReservaAgrupadoFolio($factura, $reserva, $folioAct, 1);
$sinImpuesto = $hotel->getConsumosReservasinImpuestos($factura, $reserva, $folioAct, 1);

if (count($sinImpuesto) != 0) {
  $totalSinImpto = $sinImpuesto[0]['cargos'];
}

$eFact = [];
$eCust = [];
$ePago = [];
$eLmon = [];
$eTaxe = [];
$eRete = [];
$reten = [];
$eInvo = [];
$ehold = [];
$errores = [];

$eFact['number'] = $factura;
$eFact['type_document_id'] = 1;
$eFact['date'] = $fechaFac;
$eFact['time'] = $horaFact;
$eFact['resolution_number'] = $resolucion;
$eFact['prefix'] = $prefijo;
$eFact['notes'] = strtoupper($detalle);
$eFact['disable_confirmation_text'] = true;
$eFact['establishment_name'] = NAME_EMPRESA;
$eFact['establishment_address'] = ADRESS_EMPRESA;
$eFact['establishment_phone'] = TELEFONO_EMPRESA;
$eFact['establishment_municipality'] = CODE_CITY_COMPANY;
$eFact['establishment_email'] = MAIL_HOTEL;
$eFact['sendmail'] = false;
$eFact['sendmailtome'] = false;
$eFact['send_customer_credentials'] = false;
$eFact['head_note'] = '';
$eFact['foot_note'] = '';

$eCust['identification_number'] = $nitFact;
$eCust['dv'] = $dvFact;
$eCust['name'] = $nomFact;
$eCust['email'] = $emaFact;

if ($tipofac == 2) {
  $eCust['address'] = $dirFact;
  $eCust['phone'] = $telFact;
  $eCust['merchant_registration'] = $merFact;
  $eCust['type_document_identification_id'] = $tdiFact;
  $eCust['type_organization_id'] = $torFact;
  $eCust['type_liability_id'] = $tliFact;
  $eCust['municipality_id'] = $munFact;
  $eCust['type_regime_id'] = $triFact;
}

$ePago['payment_form_id'] = $hotel->traeCodigoDianVenta($codigo);
$ePago['payment_method_id'] = $hotel->traeCodigoDianVenta($codigo);
$ePago['payment_due_date'] = $fechaVen;
$ePago['duration_measure'] = $diasCre;

$tax_totals = [];
foreach ($folios as $folio1) {
  $taxfolio = [];
  $taxTot = [];
  if ($folio1['porcentaje_impto'] != 0) {
    $taxTot = [
      'tax_id' => $hotel->traeCodigoDianVenta($folio1['codigo_impto']),
      'tax_amount' => $folio1['imptos'],
      'percent' => number_format($folio1['porcentaje_impto'], 0),
      'taxable_amount' => $folio1['cargos'],
    ];
    array_push($taxfolio, $taxTot);
    array_push($tax_totals, $taxTot);
  }
  if ($folio1['porcentaje_impto'] != 0) {
    $invo = [
      'unit_measure_id' => $hotel->traeTipoUnidadDianVenta($folio1['id_codigo_cargo']),
      'invoiced_quantity' => 1,
      'line_extension_amount' => $folio1['cargos'],
      'free_of_charge_indicator' => false,
      'tax_totals' => $taxfolio,
      'description' => $folio1['descripcion_cargo'],
      'notes' => '',
      'code' => $hotel->traeCodigoDianVenta($folio1['id_codigo_cargo']),
      'type_item_identification_id' => 4,
      'price_amount' => $folio1['cargos'] + $folio1['imptos'],
      'base_quantity' => 1,
    ];
  } else {
    $invo = [
      'unit_measure_id' => $hotel->traeTipoUnidadDianVenta($folio1['id_codigo_cargo']),
      'invoiced_quantity' => 1,
      'line_extension_amount' => $folio1['cargos'],
      'free_of_charge_indicator' => false,
      'description' => $folio1['descripcion_cargo'],
      'notes' => '',
      'code' => $hotel->traeCodigoDianVenta($folio1['id_codigo_cargo']),
      'type_item_identification_id' => 4,
      'price_amount' => $folio1['cargos'] + $folio1['imptos'],
      'base_quantity' => 1,
    ];
  }
  array_push($eInvo, $invo);
}
foreach ($tipoimptos as $impto) {
  if ($impto['porcentaje_impto'] != 0) {
    $tax = [
      'tax_id' => $hotel->traeCodigoDianVenta($impto['id_cargo']),
      'tax_amount' => $impto['imptos'],
      'taxable_amount' => $impto['cargos'],
      'percent' => number_format($impto['porcentaje_impto'], 0),
    ];
    array_push($eTaxe, $tax);
  }
}

foreach ($valorRet as $rete) {
  $ret = [
    'tax_id' => '6',
    'tax_amount' => $rete['valorRetencion'],
    'taxable_amount' => $rete['base'],
    'percent' => $rete['porcentajeRetencion'],
  ];

  array_push($eRete, $ret);
}

if (count($eTaxe) == 0) {
  $eLmon['tax_exclusive_amount'] = 0;
} else {
  $eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'] - $totalSinImpto;
}
$eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
$eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
$eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

$riva = [
  'tax_id' => '5',
  'tax_amount' => $reteiva,
  'taxable_amount' => $baseIva,
  'percent' => $porceReteiva,
];

$rica = [
  'tax_id' => '7',
  'tax_amount' => $reteica,
  'taxable_amount' => $baseIca,
  'percent' => $porceReteica,
];

if ($reteiva > 0) {
  array_push($eRete, $riva);
}
if ($reteica > 0) {
  array_push($eRete, $rica);
}

$oMode = [
  "company" => "HOTEL DON LOLO LTDA - Nit .: 892002427 - 7",
  "software" =>  "Facturación Electrónica - SACTel PMS ",
];

$eFact['customer'] = $eCust;
$eFact['payment_form'] = $ePago;
$eFact['legal_monetary_totals'] = $eLmon;
$eFact['with_holding_tax_total'] = $eRete;
if (count($eTaxe) > 0) {
  $eFact['tax_totals'] = $eTaxe;
}
$eFact['invoice_lines'] = $eInvo;
$eFact['operation_mode'] = $oMode;
$eFact = json_encode($eFact);

echo $eFact;
