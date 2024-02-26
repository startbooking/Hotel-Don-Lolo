<?php
    require '../../../res/php/app_topHotel.php'; 
    
    
    $nroFactura = '15537';
    
    $diasCre = 0;
    
    $resFac = $hotel->getResolucion(1);
    $resolucion = $resFac[0]['resolucion'];
    $prefijo = $resFac[0]['prefijo'];
    $fechaRes = $resFac[0]['fecha'];
    $desde = $resFac[0]['desde'];
    $hasta = $resFac[0]['hasta'];
    
    $infoFE = $hotel->traeInfoFE($nroFactura);
    
    // echo print_r($infoFE);
    
    
    $cufe = $infoFE[0]['cufe'];
    $timeCrea = $infoFE[0]['timeCreated'];
    
    $dataFac = $hotel->traeDatosFactura($nroFactura);
    
    
    // echo $nroFactura;
    // echo print_r($dataFac);
    
    $reserva  = $dataFac[0]['numero_reserva'];
    $tipofac  = $dataFac[0]['tipo_factura'];
    $nroFolio = $dataFac[0]['folio_cargo'] ;
    $idhues   = $dataFac[0]['id_huesped'];
    $idcia    = $dataFac[0]['id_perfil_factura'];
    
    $idhuesped = $idhues;
    
    // echo $idhuesped;
    
        
    if ($tipofac == 1) {
        $id = $idhues;
    } else {
        $id = $idcia;
        $datosCompania = $hotel->getSeleccionaCompania($idperfil);
        $diasCre = $datosCompania[0]['dias_credito'];
        $dataCompany = $hotel->getSeleccionaCompania($id);
        if ($codigo == 2) {
            $diasCre = $dataCompany[0]['dias_credito'];
            $fechaVen = strtotime('+ '.$diasCre.' day', strtotime($fechaFac));
            $fechaVen = date('Y-m-d', $fechaVen);
        }
    }
    
    // $nroFactura = $numfactura;
    $idperfil = $id;

    // echo $tipofac;
        
        
        /* $respofact = file_get_contents("../../json/HDL-15448.json");    
    $prefijo = 'HDL';    
    $eFact = '';
    
    $recibeCurl = json_decode($respofact, true);
    
    $errorMessage = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusResponse']['GetStatusResult']['ErrorMessage'];
    echo $errorMessage;
    $Isvalid      = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusResponse']['GetStatusResult']['IsValid'];
    $statusCode   = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusResponse']['GetStatusResult']['StatusCode'];
    $statusDesc   = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusResponse']['GetStatusResult']['StatusDescription'];
    $statusMess   = $recibeCurl['ResponseDian']['Envelope']['Body']['GetStatusResponse']['GetStatusResult']['StatusMessage'];

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
    
    echo $sendSucc;
    echo $sendDate;
    echo $cufe; */
    
    /* echo $nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $Isvalid, $eFact, $errorMessage, $statusCode, $statusDesc, $statusMess ; */
    
    /* $QRStr = [
      NumFac:
      FecFac:
      NitFac:
      DocAdq:
      ValFac:
      ValIva:
      ValOtroIm:
      ValTotal:
      CUFE:
      ]
    
     */


  

    /* $regis = $hotel->ingresaDatosFe($nroFactura, $prefijo, $timeCrea, $message, $sendSucc, $sendDate, $respo, $invoicexml, $zipinvoicexml, $unsignedinvoicexml, $reqfe, $rptafe, $attacheddocument, $urlinvoicexml, $urlinvoicepdf, $cufe, $QRStr, '', $Isvalid, $eFact, $errorMessage, $statusCode, $statusDesc, $statusMess); */
    
    // echo 'Antes de Factura ' ;
    
    include_once '../../imprimir/imprimeFacturaCopia.php';

    // echo 'Despues de Factura ' ;


    /* $ePDF = [];

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

    $ePDF = json_encode($ePDF); */

    // include_once '../../api/enviaPDF.php';

    // $recibePDF = json_decode($respopdf, true);


/* if ($totalFolio != 0) {
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
    /* array_push($estadofactura, '0');
    $estadoReserva = $hotel->estadoReserva($reserva); 
    $salida = $hotel->updateReservaHuespedSalida($numero, $usuario, $idUsuario, FECHA_PMS);

    if($estadoReserva== 'CA'){
        $habSucia = $hotel->updateEstadoHabitacion($room);
    } 
}
 
echo json_encode($estadofactura); */