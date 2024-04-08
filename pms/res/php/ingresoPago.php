<?php

require_once '../../../res/php/app_topHotel.php';

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);
  
$eToken = $hotel->datosTokenCia();
$token = $eToken[0]['token'];
$password = $eToken[0]['password'];
$facturador = $eToken[0]['facturador'];

$estadofactura = []; 
$refer = strtoupper($refer);
$detalle = strtoupper($detalle);
$canti = 1;

$fecha = FECHA_PMS;

$fechaAct = strtotime(FECHA_PMS.'T20:55:20');
  
$arcCurl = 'recibeCurl'.$mes.$anio.'.json';
$envCurl = 'enviaFact'.$mes.$anio.'.json';

if ($reteiva == 0) {
  $baseIva = 0;
}

if ($retefuente == 0) {
    $baseRete = 0;
}

if ($reteica == 0) {
    $baseIca = 0;
}

$idhuesped = $idhues;

$horaFact = date('H:s:i');

$resFac = $hotel->getResolucion(1);
$resolucion = $resFac[0]['resolucion'];
$prefijo = $resFac[0]['prefijo'];
$fechaRes = $resFac[0]['fecha'];
$desde = $resFac[0]['desde'];
$hasta = $resFac[0]['hasta'];

$fechaFac = $fecha;
$fechaVen = $fecha;
$diasCre = 0;
$paganticipo = 0;
$totalSinImpto = 0;

if ($perfilFac == 1 && $facturador == 1) {
    $numfactura = $hotel->getNumeroFactura(); // Numero Actual de la Factura
    /* Cambiar de Ubicacion -> Despues de Validar la Factura por la DIAN */ 
    $nuevonumero = $hotel->updateNumeroFactura($numfactura + 1); // Actualiza Consecutivo de la Factura
} else {
    $perfilFac == 2;
    $numfactura = $hotel->getNumeroAbono(); // Numero Actual del Abono
    $nuevonumero = $hotel->updateNumeroAbonos($numfactura + 1); // Actualiza Consecutivo del Abono
}

if ($tipofac == 1) {
  $id = $idhues;
}else {
  $id = $idcia;
  $dataCompany = $hotel->getSeleccionaCompania($id);
  if ($codigo == 2) {
    $diasCre = $dataCompany[0]['dias_credito'];
    $fechaVen = strtotime('+ '.$diasCre.' day',strtotime($fechaFac));
    $fechaVen = date('Y-m-d', $fechaVen);
  }
}

$nroFactura = $numfactura;
$idperfil = $id;

$inserta = $hotel->insertFacturaHuesped($codigo, $textopago, $valor, strtoupper($refer), $reserva, $room, $idhues, $folioAct, $canti, $usuario, $usuario_id, $fecha, $numfactura, $tipofac, $id, $idcentro, $prefijo, $perfilFac, strtoupper($detalle), $baseRete, $baseIva, $baseIca, $reteiva, $reteica, $retefuente, $correofac);

$factu = $hotel->updateCargosReservaFolio($reserva, $numfactura, $folioAct, $fecha, $usuario, $idUsuario, $tipofac, $id, $perfilFac);

$saldos = $hotel->getValorFactura($numfactura);
$anticipos = $hotel->valorAnticipos($numfactura);

if (count($anticipos) != 0) {
    $paganticipo = $anticipos[0]['pagos'];
}

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
    $nomFact = $datosCompania[0]['empresa'];
    $nitFact = $datosCompania[0]['nit'];
    $dvFact = $datosCompania[0]['dv'];
    $emaFact = $datosCompania[0]['email'];
    $tdiFact = $datosCompania[0]['tipo_documento'];
    $triFact = $datosCompania[0]['tipoResponsabilidad']; 
    
    // $dirFact = $datosCompania[0]['direccion'];
    // $telFact = $datosCompania[0]['telefono'];
    // $merFact = '0000000-00';
    // $torFact = $datosCompania[0]['tipoAdquiriente'];
    // $tliFact = $hotel->traeIdResponsabilidadDianVenta($datosCompania[0]['responsabilidadTributaria']);
    // $munFact = $datosCompania[0]['ciudad'];
    // $triFact = 1;
    
} else {
    $datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
    $nitFact = $datosHuesped[0]['identificacion'];
    $dvFact = '';
    $nomFact = $datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'].' '.$datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'];
    $emaFact = $datosHuesped[0]['email'];
    $tdiFact = $datosHuesped[0]['tipo_identifica'];
    $triFact = $datosHuesped[0]['tipoResponsabilidad'];
    // $telFact = $datosHuesped[0]['telefono'];
    
}

$updFac = $hotel->updateFactura($idUsuario, $saldos[0]['cargos'], $saldos[0]['imptos'], $saldos[0]['pagos'], $saldos[0]['base'], $paganticipo, $fechaVen, $numfactura, $usuario, $fecha, $diasCre);

$totalPago = $paganticipo + $saldos[0]['pagos'];
$saldofactura = $hotel->getSaldoHabitacion($reserva);

if (count($saldofactura) == 0) {
    $totalFolio = 0;
} else {
    $totalFolio = ($saldofactura[0]['cargos'] + $saldofactura[0]['imptos']);
}

$folios = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $folioAct, 1);
$pagosfolio = $hotel->getConsumosReservaAgrupadoCodigoFolio($nroFactura, $reserva, $folioAct, 3);
$tipoimptos = $hotel->getValorImptoFolio($nroFactura, $reserva, $folioAct, 2);
$subtotales = $hotel->getConsumosReservaAgrupadoFolio($nroFactura, $reserva, $folioAct, 1);
$sinImpuesto = $hotel->getConsumosReservasinImpuestos($nroFactura, $reserva, $folioAct, 1);

if(count($sinImpuesto) != 0){
  $totalSinImpto = $sinImpuesto[0]['cargos'];
}

if ($perfilFac == 1 && $facturador == 1) {
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

    $eFact['number'] = $nroFactura;
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
    $eCust['phone'] = $telFact;
    $eCust['email'] = $emaFact;
    
    /* if($tipofac == 2){
      $eCust['address'] = $dirFact;
      $eCust['merchant_registration'] = $merFact;
      $eCust['type_document_identification_id'] = $tdiFact;
      $eCust['type_organization_id'] = $torFact;
      $eCust['type_liability_id'] = $tliFact;
      $eCust['municipality_id'] = $munFact;
      $eCust['type_regime_id'] = $triFact;
    } */

    $ePago['payment_form_id'] = $hotel->traeCodigoDianVenta($codigo);
    $ePago['payment_method_id'] = $hotel->traeCodigoDianVenta($codigo);
    $ePago['payment_due_date'] = $fechaVen;
    $ePago['duration_measure'] = $diasCre;

    $eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos']-$totalSinImpto;
    $eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
    $eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

    $tax_totals = [];
    foreach ($folios as $folio1) {
        $taxfolio = [];
        $taxTot = [];
        if($folio1['porcentaje_impto']!=0){
            $taxTot = [
                'tax_id' => $hotel->traeCodigoDianVenta($folio1['codigo_impto']),
                'tax_amount' => $folio1['imptos'],
                'percent' => number_format($folio1['porcentaje_impto'], 0),
                'taxable_amount' => $folio1['cargos'],
            ];            
            array_push($taxfolio, $taxTot);
            array_push($tax_totals, $taxTot);
        }        
        if($folio1['porcentaje_impto']!=0){
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
        }else{
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
        if($impto['porcentaje_impto']!=0){
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
            'tax_amount' => $rete['retencion'],
            'taxable_amount' => $rete['base'],
            'percent' => $rete['porcentajeRetencion'],
        ];

        array_push($eRete, $ret);
    }
    
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
        "company" => "NEXTPYME COLOMBIA S.A.S - Nit .: 901249232 - 0",
        "software" =>  "Facturación Electrónica - SACTel PMS ",
    ];
    
    $eFact['customer'] = $eCust;
    $eFact['payment_form'] = $ePago;
    $eFact['legal_monetary_totals'] = $eLmon;
    $eFact['with_holding_tax_total'] = $eRete;
    $eFact['tax_totals'] = $eTaxe;
    $eFact['invoice_lines'] = $eInvo;
    $eFact['operation_mode'] = $oMode;       
    $eFact = json_encode($eFact);
        
    // include_once '../../api/enviaFactura.php';            
    
    include_once '../../api/prueba.php';            
    $recibeCurl = json_decode(trim($respofact), true);
    
    file_put_contents($envCurl, $eFact.',',  FILE_APPEND | LOCK_EX);
    file_put_contents($arcCurl, $respofact.',',  FILE_APPEND | LOCK_EX);
    
    $errores = $recibeCurl['errors'];
    $success = $recibeCurl['success'];
    
    $noAutorizado = $recibeCurl['message'];
    
    $errorMessage = json_encode($recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['ErrorMessage']);
    $Isvalid  = $recibeCurl['ResponseDian']['Envelope']['Body']['SendBillSyncResponse']['SendBillSyncResult']['IsValid'];
    
    $error = [
        'error' => '0'
    ];
    
    if(isset($errores)){
        if(count($errores) > 0){
          $error = [
            'error' => '1',
            'folio' => '0',
            'mensaje' => $errores, 
            'factura' => $numfactura,
            'errorDian' => '0',
            'perfil' => $perfilFac,
            'archivo' => '',                
          ];
          array_push($estadofactura, $error);
          echo json_encode($estadofactura);        
          return; 
        }
    }
        
    if($noAutorizado=='Unauthenticated.'){
        $error = [
          'error' => '1',
          'folio' => '0',
          'mensaje' => 'Usuario NO Autorizado en Facturacion Electronica', 
          'factura' => $numfactura,
          'errorDian' => '0',
          'perfil' => $perfilFac,
          'archivo' => '',          
        ];
        array_push($estadofactura, $error);
        echo json_encode($estadofactura);        
        return; 
    }

    if($Isvalid=="false"){
        $error = [
            'error' => '1',
            'folio' => '0',
            'mensaje' => $errorMessage, 
            'factura' => $numfactura,
            'errorDian' => '1',
            'perfil' => $perfilFac,   
            'archivo' => '',
        ]; 
        array_push($estadofactura, $error);
        echo json_encode($estadofactura);        
        return; 
    }
    
    if(isset($success) ){
        $error = [
            'error' => '1',
            'folio' => '0',
            'mensaje' => $recibeCurl['message'], 
            'factura' => $numfactura,
            'errorDian' => '0',
            'perfil' => $perfilFac,
            'archivo' => '',
        ];
        array_push($estadofactura, $error);
        echo json_encode($estadofactura);        
        return; 
    }
    
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
    $cufe  = $recibeCurl['cufe'];
    $QRStr = $recibeCurl['QRStr'];
    $timeCrea   = $recibeCurl['ResponseDian']['Envelope']['Header']['Security']['Timestamp']['Created'];

    $respo = '';

    $regis = $hotel->ingresaDatosFe($nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $Isvalid, '', $errorMessage, $statusCode, $statusDesc, $statusMess);

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

    // include_once '../../api/enviaPDF.php';
    
    $recibePDF = json_decode($respopdf, true);

} else {
    include_once '../../imprimir/imprimeReciboFactura.php';
    
}

if ($totalFolio != 0) {
    $saldohabi = ($saldofactura[0]['cargos'] + $saldofactura[0]['imptos']) - $saldofactura[0]['pagos'];
    $saldofolio2 = $hotel->saldoFolio($reserva, 2);
    $saldofolio1 = $hotel->saldoFolio($reserva, 1);
    $saldofolio3 = $hotel->saldoFolio($reserva, 3);   
    $saldofolio4 = $hotel->saldoFolio($reserva, 4);

    if ($saldofolio1 != 0) {
        $error = [
            'error' => '0',
            'folio' => '1',
            'mensaje' => '', 
            'archivo' => $oFile,
            'factura' => $numfactura,
            'errorDian' => '0',
            'perfil' => $perfilFac,            
        ];
        array_push($estadofactura, $error);
    }
    
    if ($saldofolio2 != 0) {
        $error = [
            'error' => '0',
            'folio' => '2',
            'mensaje' => '', 
            'archivo' => $oFile,            
            'errorDian' => '0',
            'perfil' => $perfilFac,            
        ];
        array_push($estadofactura, $error);
    }

    if ($saldofolio3 != 0) {
        $error = [
            'error' => '0',
            'folio' => '3',
            'mensaje' => '', 
            'archivo' => $oFile,
            'errorDian' => '0',
            'perfil' => $perfilFac,            
        ];
        array_push($estadofactura, $error); 
    }

    if ($saldofolio4 != 0) {
        $error = [
            'error' => '0',
            'folio' => '4',
            'mensaje' => '', 
            'archivo' => $oFile,        
            'errorDian' => '0',
            'perfil' => $perfilFac,            
        ];
        array_push($estadofactura, $error);
    }    
} else {
    $error = [
        'error' => '0',
        'folio' => '0',
        'mensaje' => '', 
        'archivo' => $oFile,
        'errorDian' => '0',
        'perfil' => $perfilFac,            
    ];
    
    array_push($estadofactura, $error);
    
    $estadoReserva = $hotel->estadoReserva($reserva); 
    $salida = $hotel->updateReservaHuespedSalida($reserva, $usuario, $idUsuario, FECHA_PMS);

    if($estadoReserva== 'CA'){
        $habSucia = $hotel->updateEstadoHabitacion($room);
    } 
}
 
echo json_encode($estadofactura);
