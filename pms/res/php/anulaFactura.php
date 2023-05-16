<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$numero = $_POST['numero'];
$motivo = strtoupper($_POST['motivo']);
$reserva = $_POST['reserva'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['usuario_id'];

$horaDoc = date('H:s:i');
$fechaDoc = FECHA_PMS;
$prefNC = $hotel->getPrefijoNC();
$numDoc = $hotel->getNumeroCredito();
$regis = $hotel->actualizaNumeroCredito($numDoc + 1);

$resFac = $hotel->getResolucion();

$resolucion = $resFac[0]['resolucion'];
$prefijo = $resFac[0]['prefijo'];
$fechaRes = $resFac[0]['fecha'];
$desde = $resFac[0]['desde'];
$hasta = $resFac[0]['hasta'];

$dFactura = $hotel->infoFactura($numero);

$tipofac = $dFactura[0]['tipo_factura'];
$idperfil = $dFactura[0]['id_perfil_factura'];
$reserva = $dFactura[0]['numero_reserva'];
$nroFolio = $dFactura[0]['folio_cargo'];

// echo print_r($dFactura);

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($numero, $reserva, $nroFolio, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($numero, $reserva, $nroFolio, 3);
$tipoimptos = $hotel->getValorImptoFolio($numero, $reserva, $nroFolio, 2);

$subtotales = $hotel->getConsumosReservaAgrupadoFolio($numero, $reserva, $nroFolio, 1);

$eNote = [];
$eBill = [];
$eCust = [];
$eTaxe = [];
$eInvo = [];

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    // $diasCre = $datosCompania[0]['dias_credito'];
    $nomFact = utf8_decode($datosCompania[0]['empresa']);
    $nitFact = $datosCompania[0]['nit'];
    $dvFact = $datosCompania[0]['dv'];
    $dirFact = utf8_decode($datosCompania[0]['direccion']);
    $telFact = $datosCompania[0]['telefono'];
    $emaFact = $datosCompania[0]['email'];
    $merFact = '';
    $tdiFact = $hotel->traeCodigoIdentifica($datosCompania[0]['tipo_documento']);
    $torFact = $datosCompania[0]['tipoAdquiriente'];
    $tliFact = '';
    $munFact = $hotel->traeCodigoCiudad($datosCompania[0]['ciudad']);
    $triFact = $datosCompania[0]['responsabilidadTributaria'];
} else {
    $datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
    $nitFact = $datosHuesped[0]['identificacion'];
    $dvFact = '';
    $nomFact = utf8_decode($datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'].' '.$datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2']);
    $telFact = $datosHuesped[0]['telefono'];
    $dirFact = utf8_decode($datosHuesped[0]['direccion']);
    $emaFact = $datosHuesped[0]['email'];
    $merFact = '';
    $tdiFact = $hotel->traeCodigoIdentifica($datosHuesped[0]['tipo_identifica']);
    $torFact = $datosHuesped[0]['tipoAdquiriente'];
    $tliFact = '';
    $munFact = $hotel->traeCodigoCiudad($datosHuesped[0]['ciudad']);
    $triFact = $datosHuesped[0]['responsabilidadTributaria'];
}

$eBill['number'] = $dFactura[0]['prefijo'].$dFactura[0]['factura_numero'];
$eBill['uuid'] = '';
$eBill['issue_date'] = $dFactura[0]['fecha_factura'];

$eNote['billing_reference'] = $eBill;

$eNote['discrepancyresponsecode'] = 2;
$eNote['discrepancyresponsedescription'] = $motivo;
$eNote['notes'] = '';
$eNote['resolution_number'] = $resolucion;
$eNote['prefix'] = $prefNC;
$eNote['number'] = $numDoc;
$eNote['type_document_id'] = 4;
$eNote['date'] = $fechaDoc;
$eNote['time'] = $horaDoc;
$eNote['establishment_name'] = NAME_EMPRESA;
$eNote['establishment_address'] = ADRESS_EMPRESA;
$eNote['establishment_phone'] = TELEFONO_EMPRESA;
$eNote['establishment_municipality'] = CODE_CITY_COMPANY;
$eNote['sendmail'] = true;
$eNote['sendmailtome'] = true;
$eNote['seze'] = '2021-2017';
$eNote['head_note'] = 'PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN';
$eNote['foot_note'] = 'PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN';

$eCust['identification_number'] = $nitFact;
$eCust['dv'] = $dvFact;
$eCust['name'] = $nomFact;
$eCust['phone'] = $telFact;
$eCust['address'] = $dirFact;
$eCust['email'] = $emaFact;
$eCust['merchant_registration'] = $merFact;
$eCust['type_document_identification_id'] = $tdiFact;
$eCust['type_organization_id'] = $torFact;
$eCust['type_liability_id'] = $tliFact;
$eCust['municipality_id'] = $munFact;
$eCust['type_regime_id'] = $triFact;

$eNote['customer'] = $eCust;

$eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
$eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'];
$eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
$eLmon['allowance_total_amount'] = 0;
$eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

$eNote['legal_monetary_totals'] = $eLmon;

$tax_totals = [];

foreach ($folios as $folio1) {
    $taxTot = [];
    $taxTot = [
        'tax_id' => $folio1['codigo_impto'],
        'tax_amount' => $folio1['imptos'],
        'taxable_amount' => $folio1['cargos'],
        'percent' => number_format($folio1['porcentaje_impto'], 0),
    ];

    array_push($tax_totals, $taxTot);

    $invo = [
      'unit_measure_id' => $folio1['id_codigo_cargo'],
      'invoiced_quantity' => 1,
      'line_extension_amount' => $folio1['cargos'],
      'free_of_charge_indicator' => false,
      'tax_totals' => $taxTot,
      'description' => $folio1['descripcion_cargo'],
      'notes' => '',
      'code' => '',
      'type_item_identification_id' => $folio1['id_codigo_cargo'],
      'price_amount' => $folio1['imptos'] + $folio1['cargos'],
      'base_quantity' => 1,
    ];

    array_push($eInvo, $invo);
}

foreach ($tipoimptos as $impto) {
    $tax = [
        'tax_id' => $impto['id_cargo'],
        'tax_amount' => $impto['imptos'],
        'taxable_amount' => $impto['cargos'],
        'percent' => number_format($impto['porcentaje_impto'], 0),
    ];

    array_push($eTaxe, $tax);
}

$eNote['tax_totals'] = $eTaxe;
$eNote['credit_note_lines'] = $eInvo;

$eNote = json_encode($eNote);

include_once '../../api/NotaCredito.php';

include_once '../../imprimir/imprimeNotaCredito.php';

/*
include_once '../../imprimir/imprimeFacturaAnulada.php';
*/

$cargos = $hotel->actualizaCargosFacturas($numero);
$anula = $hotel->anulaFactura($numero, $motivo, $usuario, $idusuario);
$entra = $hotel->updateEstadoReserva($reserva);
// echo $entra;
