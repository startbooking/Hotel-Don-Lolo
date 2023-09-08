<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$numero = $_POST['numero'];
$motivo = strtoupper($_POST['motivo']);
$reserva = $_POST['reserva'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['usuario_id'];
$perfil = $_POST['perfil'];

$horaDoc = date('H:s:i');
$fechaDoc = FECHA_PMS;
$prefNC = $hotel->getPrefijoNC();
$numDoc = $hotel->getNumeroCredito();
$regis = $hotel->actualizaNumeroCredito($numDoc + 1);

$eToken = $hotel->datosTokenCia();
$token = $eToken[0]['token'];
$password = $eToken[0]['password'];
$facturador = $eToken[0]['facturador'];

$resFac = $hotel->getResolucion();

$retenciones = $hotel->trarRetenciones(1);

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

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($numero, $reserva, $nroFolio, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($numero, $reserva, $nroFolio, 3);
$tipoimptos = $hotel->getValorImptoFolio($numero, $reserva, $nroFolio, 2);
$subtotales = $hotel->getConsumosReservaAgrupadoFolio($numero, $reserva, $nroFolio, 1);

$codigo = $pagosfolio[0]['id_codigo_cargo'];

if ($perfil == 1 && $facturador == 1) {
    $datosFact = $hotel->traeDatosFE($numero);

    $uuid = $datosFact[0]['cufe'];

    $eNote = [];
    $eBill = [];
    $eCust = [];
    $eTaxe = [];
    $eInvo = [];

    if ($tipofac == 2) {
        $datosCompania = $hotel->getSeleccionaCompania($idperfil);
        $diasCre = $datosCompania[0]['dias_credito'];
        $nomFact = utf8_decode($datosCompania[0]['empresa']);
        $nitFact = $datosCompania[0]['nit'];
        $dvFact = $datosCompania[0]['dv'];
        $dirFact = utf8_decode($datosCompania[0]['direccion']);
        $telFact = $datosCompania[0]['telefono'];
        $emaFact = $datosCompania[0]['email'];
        $merFact = '0000000-00';
        $tdiFact = $datosCompania[0]['tipo_documento'];
        $torFact = $datosCompania[0]['tipoAdquiriente'];
        $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosCompania[0]['responsabilidadTributaria']);
        $munFact = $datosCompania[0]['ciudad'];
        $triFact = 1;
    } else {
        $datosHuesped = $hotel->getbuscaDatosHuesped($idperfil);
        $nitFact = $datosHuesped[0]['identificacion'];
        $dvFact = '';
        $nomFact = utf8_decode($datosHuesped[0]['nombre1'] . ' ' . $datosHuesped[0]['nombre2'] . ' ' . $datosHuesped[0]['apellido1'] . ' ' . $datosHuesped[0]['apellido2']);
        $telFact = $datosHuesped[0]['telefono'];
        $dirFact = utf8_decode($datosHuesped[0]['direccion']);
        $emaFact = $datosHuesped[0]['email'];
        $merFact = '0000000-00';
        $tdiFact = $datosHuesped[0]['tipo_identifica'];
        $torFact = $datosHuesped[0]['tipoAdquiriente'];
        $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosHuesped[0]['responsabilidadTributaria']);
        $munFact = $datosHuesped[0]['ciudad'];
        $triFact = 2;
    }

    $eBill['number'] = strval($dFactura[0]['factura_numero']);
    $eBill['uuid'] = $uuid;
    $eBill['issue_date'] = $dFactura[0]['fecha_factura'];

    $eNote['billing_reference'] = $eBill;

    $eNote['discrepancyresponsecode'] = 2;
    $eNote['discrepancyresponsedescription'] = $motivo;
    $eNote['notes'] = '';
    // $eNote['resolution_number'] = $resolucion;
    $eNote['prefix'] = $prefNC;
    $eNote['number'] = $numDoc;
    $eNote['type_document_id'] = 4;
    $eNote['date'] = $fechaDoc;
    $eNote['time'] = $horaDoc;
    $eNote['establishment_name'] = NAME_EMPRESA;
    $eNote['establishment_address'] = ADRESS_EMPRESA;
    $eNote['establishment_phone'] = TELEFONO_EMPRESA;
    $eNote['establishment_municipality'] = CODE_CITY_COMPANY;
    $eNote['sendmail'] = false;
    $eNote['sendmailtome'] = false;
    $eNote['seze'] = '2021-2017';
    $eNote['head_note'] = '';
    $eNote['foot_note'] = '';

    $eCust['identification_number'] = $nitFact;
    $eCust['dv'] = $dvFact;
    $eCust['name'] = $nomFact;
    $eCust['phone'] = $telFact;
    $eCust['email'] = $emaFact;

    if ($tipofac == 2) {
        $eCust['address'] = $dirFact;
        $eCust['merchant_registration'] = $merFact;
        $eCust['type_document_identification_id'] = $tdiFact;
        $eCust['type_organization_id'] = $torFact;
        $eCust['type_liability_id'] = $tliFact;
        $eCust['municipality_id'] = $munFact;
        $eCust['type_regime_id'] = $triFact;
    }

    $eNote['customer'] = $eCust;

    $eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
    $eLmon['allowance_total_amount'] = 0;
    $eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

    $eNote['legal_monetary_totals'] = $eLmon;

    $tax_totals = [];
    foreach ($folios as $folio1) {
        $taxfolio = [];
        $taxTot = [];
        $taxTot = [
            'tax_id' => $hotel->traeCodigoDianVenta($folio1['codigo_impto']),
            'tax_amount' => $folio1['imptos'],
            'percent' => number_format($folio1['porcentaje_impto'], 0),
            'taxable_amount' => $folio1['cargos'],
        ];

        array_push($taxfolio, $taxTot);
        array_push($tax_totals, $taxTot);

        $invo = [
            'unit_measure_id' => $hotel->traeTipoUnidadDianVenta($folio1['id_codigo_cargo']),
            'invoiced_quantity' => 1,
            'line_extension_amount' => $folio1['cargos'],
            'free_of_charge_indicator' => false,
            'tax_totals' => $taxfolio,
            'description' => $folio1['descripcion_cargo'],
            'notes' => '',
            'code' => $hotel->traeCodigoDianVenta($folio1['id_codigo_cargo']),
            'type_item_identification_id' => 1,
            'price_amount' => $folio1['cargos'] + $folio1['imptos'],
            'base_quantity' => 1,
        ];

        array_push($eInvo, $invo);
    }

    foreach ($tipoimptos as $impto) {
        $tax = [
            'tax_id' => $hotel->traeCodigoDianVenta($impto['id_cargo']),
            'tax_amount' => $impto['imptos'],
            'taxable_amount' => $impto['cargos'],
            'percent' => number_format($impto['porcentaje_impto'], 0),
        ];

        array_push($eTaxe, $tax);
    }

    $eNote['tax_totals'] = $eTaxe;
    $eNote['credit_note_lines'] = $eInvo;

    $eNote = json_encode($eNote);

    include_once '../../api/enviaNC.php';

    $recibeCurl = json_decode($respoNC, true);

    $message = $recibeCurl['message'];
    $sendSucc = $recibeCurl['send_email_success'];
    $sendDate = $recibeCurl['send_email_date_time'];

    $invoicexml = '';
    $zipinvoicexml = '';
    $unsignedinvoicexml = '';
    $reqfe = '';
    $rptafe = '';
    $attacheddocument = '';

    $urlinvoicexml = $recibeCurl['urlinvoicexml'];
    $urlinvoicepdf = $recibeCurl['urlinvoicepdf'];
    $cude = $recibeCurl['cude'];
    $QRStr = $recibeCurl['QRStr'];
    $timeCrea = $recibeCurl['ResponseDian']['Envelope']['Header']['Security']['Timestamp']['Created'];
    $respo = '';

    $errorMessage = json_encode($recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['ErrorMessage']);
    $Isvalid = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['IsValid'];
    $statusCode = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusCode'];
    $statusDesc = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusDescription'];
    $statusMess = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusMessage'];

    $message = $recibeCurl['message'];

    $regis = $hotel->ingresaDatosFe($numDoc, $prefNC, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cude, $QRStr, '', $Isvalid, $eNote, $errorMessage, $statusCode, $statusDesc, $statusMess);

    include_once '../../imprimir/imprimeNotaCredito.php';

    $ePDF = [];

    $numNC = strval($numDoc);

    $ePDF['prefix'] = $prefNC;
    $ePDF['number'] = $numNC;
    $ePDF['base64graphicrepresentation'] = $base64NC;

    $ePDF = json_encode($ePDF);

    include_once '../../api/enviaPDF.php';

    $recibePDF = json_decode($respopdf, true);
} else {
    include_once '../../imprimir/imprimeNC.php';
}

$cargos = $hotel->actualizaCargosFacturas($numero, $perfil);
$anula = $hotel->anulaFactura($numero, $motivo, $usuario, $idusuario, $perfil, $numDoc);
$regis = $hotel->ingresaNCFactura($numero, $motivo, $idusuario, $numDoc, FECHA_PMS);

$entra = $hotel->updateEstadoReserva($reserva);
