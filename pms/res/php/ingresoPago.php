<?php

require_once '../../../res/php/app_topHotel.php';

$eToken = $hotel->datosTokenCia();
 
$token = $eToken[0]['token'];
$password = $eToken[0]['password'];
$facturador = $eToken[0]['facturador'];

$estadofactura = []; 

$codigo = $_POST['codigo'];
$textcodigo = $_POST['textopago'];
$valor = $_POST['valor']; 
$numero = $_POST['reserva'];
$room = $_POST['room'];
$idhues = $_POST['idhues'];
$canti = 1;
$folio = $_POST['folio'];
$fecha = FECHA_PMS;
$idcia = $_POST['idcia'];
$idcentro = $_POST['idcentro'];
$tipofac = $_POST['tipofac'];
$usuario = $_POST['usuario'];
$idUsuario = $_POST['usuario_id'];
$detallePag = strtoupper($_POST['detalle']);
$refer = strtoupper($_POST['refer']);
$correofac = strtolower($_POST['correofac']);
$perfilFac = $_POST['perfilFac'];
$baseRete = $_POST['baseRete'];
$baseIva = $_POST['baseIva'];
$baseIca = $_POST['baseIca'];
$reteiva = $_POST['reteiva'];
$reteica = $_POST['reteica'];
$retefuente = $_POST['retefuente'];
$porceiva = $_POST['porceReteiva'];
$porceica = $_POST['porceReteica'];
$porcefuente = $_POST['porceRetefuente'];

if ($reteiva == 0) {
    $baseIva = 0;
}

if ($retefuente == 0) {
    $baseRete = 0;
}

if ($reteica == 0) {
    $baseIca = 0;
}

$reserva = $numero;
$nroFolio = $folio;
$idhuesped = $idhues;
$diasCre = 0;

$horaFact = date('H:s:i');

$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);

$resFac = $hotel->getResolucion();
$resolucion = $resFac[0]['resolucion'];
$prefijo = $resFac[0]['prefijo'];
$fechaRes = $resFac[0]['fecha'];
$desde = $resFac[0]['desde'];
$hasta = $resFac[0]['hasta'];

$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$diasCre = 0;
$paganticipo = 0;


if ($perfilFac == 1 && $facturador == 1) {
    $numfactura = $hotel->getNumeroFactura(); // Numero Actual del Abono
    $nuevonumero = $hotel->updateNumeroFactura($numfactura + 1); // Actualiza Consecutivo del Abono
} else {
    $perfilFac == 2;
    $numfactura = $hotel->getNumeroAbono(); // Numero Actual del Abono
    $nuevonumero = $hotel->updateNumeroAbonos($numfactura + 1); // Actualiza Consecutivo del Abono
}

if ($tipofac == 1) {
    $id = $idhues;
} else {
    $id = $idcia;
    $dataCompany = $hotel->getSeleccionaCompania($id);

    if ($codigo == 2) {
        $diasCre = $dataCompany[0]['dias_credito'];
        $fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
        $fechaVen = date('Y-m-d', $fechaVen);
    }
}

$nroFactura = $numfactura;
$idperfil = $id;

$inserta = $hotel->insertFacturaHuesped($codigo, $textcodigo, $valor, $refer, $numero, $room, $idhues, $folio, $canti, $usuario, $idUsuario, $fecha, $numfactura, $tipofac, $id, $idcentro, $prefijo, $perfilFac, $detallePag, $baseRete, $baseIva, $baseIca, $reteiva, $reteica, $retefuente, $correofac);

$factu = $hotel->updateCargosReservaFolio($numero, $numfactura, $folio, $fecha, $usuario, $idUsuario, $tipofac, $id, $perfilFac);

$saldos = $hotel->getValorFactura($numfactura);
$anticipos = $hotel->valorAnticipos($numfactura);

if (count($anticipos) != 0) {
    $paganticipo = $anticipos[0]['pagos'];
}

$updFac = $hotel->updateFactura($idUsuario, $saldos[0]['cargos'], $saldos[0]['imptos'], $saldos[0]['pagos'], $saldos[0]['base'], $paganticipo, $fechaVen, $numfactura, $usuario, $fecha);

$totalPago = $paganticipo + $saldos[0]['pagos'];

$saldofactura = $hotel->getSaldoHabitacion($numero);

if (count($saldofactura) == 0) {
    $totalFolio = 0;
} else {
    $totalFolio = ($saldofactura[0]['cargos'] + $saldofactura[0]['imptos']) - $saldofactura[0]['pagos'];
}

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $nroFolio, 3);
$tipoimptos = $hotel->getValorImptoFolio($nroFactura, $reserva, $nroFolio, 2);
$subtotales = $hotel->getConsumosReservaAgrupadoFolio($nroFactura, $reserva, $nroFolio, 1);

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
    $nomFact = $datosCompania[0]['empresa'];
    $nitFact = $datosCompania[0]['nit'];
    $dvFact = $datosCompania[0]['dv'];
    $dirFact = $datosCompania[0]['direccion'];
    $telFact = $datosCompania[0]['telefono'];
    $emaFact = $datosCompania[0]['email'];
    $merFact = '0000000-00';
    $tdiFact = $datosCompania[0]['tipo_documento'];
    $torFact = $datosCompania[0]['tipoAdquiriente'];
    $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosCompania[0]['responsabilidadTributaria']);
    $munFact = $datosCompania[0]['ciudad'];
    $triFact = 1;
} else {
    $datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
    $nitFact = $datosHuesped[0]['identificacion'];
    $dvFact = '';
    $nomFact = $datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'].' '.$datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'];
    $telFact = $datosHuesped[0]['telefono'];
    $dirFact = $datosHuesped[0]['direccion'];
    $emaFact = $datosHuesped[0]['email'];
    $merFact = '0000000-00';
    $tdiFact = $datosHuesped[0]['tipo_identifica'];
    $torFact = $datosHuesped[0]['tipoAdquiriente'];
    $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosHuesped[0]['responsabilidadTributaria']);
    $munFact = $datosHuesped[0]['ciudad'];
    $triFact = 2;
}

if ($perfilFac == 1 && $facturador == 1) {
    $eFact = [];
    $eCust = [];
    $ePago = [];
    $eLmon = [];
    $eTaxe = [];
    $eInvo = [];
    $ehold = [];

    $eFact['number'] = $nroFactura;

    $eFact['type_document_id'] = 1;
    $eFact['date'] = $fechaFac;
    $eFact['time'] = $horaFact;
    $eFact['resolution_number'] = $resolucion;
    $eFact['prefix'] = $prefijo;
    $eFact['notes'] = $detallePag;
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
    $eCust['phone'] = $telFact;
    $eCust['email'] = $emaFact;
    if($tipofac == 2){
      $eCust['address'] = $dirFact;
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

    $eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
    $eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

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

    $eRete = [];

    $riva = [
        'tax_id' => '5',
        'tax_amount' => $reteiva,
        'taxable_amount' => $baseIva,
        'percent' => $porceiva,
    ];

    $rret = [
        'tax_id' => '6',
        'tax_amount' => $retefuente,
        'taxable_amount' => $baseRete,
        'percent' => $porcefuente,
    ];
    $rica = [
        'tax_id' => '7',
        'tax_amount' => $reteica,
        'taxable_amount' => $baseIca,
        'percent' => $porceica,
    ];

    if ($reteiva > 0) {
        array_push($eRete, $riva);
    }
    if ($retefuente > 0) {
        array_push($eRete, $rret);
    }
    if ($reteica > 0) {
        array_push($eRete, $rica);
    }

    $eFact['customer'] = $eCust;
    $eFact['payment_form'] = $ePago;
    $eFact['legal_monetary_totals'] = $eLmon;
    $eFact['with_holding_tax_total'] = $eRete;
    $eFact['tax_totals'] = $eTaxe;
    $eFact['invoice_lines'] = $eInvo;

    $eFact = json_encode($eFact);

    include_once '../../api/enviaFactura.php';
    
    $recibeCurl = json_decode($respofact, true);

    $errorMessage = json_encode($recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['ErrorMessage']);
    $Isvalid      = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['IsValid'];
    $statusCode   = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusCode'];
    $statusDesc   = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusDescription'];
    $statusMess   = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['StatusMessage'];

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
    $cufe = $recibeCurl['cufe'];
    $QRStr = $recibeCurl['QRStr'];
    $timeCrea   = $recibeCurl['ResponseDian']['Envelope']['Header']['Security']['Timestamp']['Created'];

    $respo = '';

    $regis = $hotel->ingresaDatosFe($nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $Isvalid, $eFact, $errorMessage, $statusCode, $statusDesc, $statusMess);

    include_once '../../imprimir/imprimeFactura.php';

    $ePDF = [];

    $miFactura = strval($nroFactura);

    $ePDF['prefix'] = $prefijo;
    $ePDF['number'] = $miFactura;
    $ePDF['base64graphicrepresentation'] = $base64Factura;

    if ($correofac != '') {
        $correos = [];
        $emailadi = [
            'email' => $correofac,
        ];
        array_push($correos, $emailadi);
        $ePDF['email_cc_list'] = $correos;
    }

    $ePDF = json_encode($ePDF);

    include_once '../../api/enviaPDF.php';

    $recibePDF = json_decode($respopdf, true); 
} else {
    include_once '../../imprimir/imprimeReciboFactura.php';
}

if ($totalFolio != 0) {
    $saldohabi = ($saldofactura[0]['cargos'] + $saldofactura[0]['imptos']) - $saldofactura[0]['pagos'];
    $saldofolio1 = $hotel->saldoFolio($numero, 1);
    $saldofolio2 = $hotel->saldoFolio($numero, 2);
    $saldofolio3 = $hotel->saldoFolio($numero, 3);
    $saldofolio4 = $hotel->saldoFolio($numero, 4);

    if ($saldofolio1 != 0) {
        array_push($estadofactura, '1');
    }
    if ($saldofolio2 != 0) {
        array_push($estadofactura, '2');
    }
    if ($saldofolio3 != 0) {
        array_push($estadofactura, '3');
    }
    if ($saldofolio4 != 0) {
        array_push($estadofactura, '4');
    }
} else {
    /* Verificar Saldo en la cuenta de esa habitacion */
    $estadoReserva = $hotel->estadoReserva($reserva); 
    $salida = $hotel->updateReservaHuespedSalida($numero, $usuario, $idUsuario, FECHA_PMS);

    if($estadoReserva== 'CA'){
        $habSucia = $hotel->updateEstadoHabitacion($room);
    } 
}

echo json_encode($estadofactura);
