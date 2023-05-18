<?php

require_once '../../../res/php/app_topHotel.php';

$estadofactura = [];

$codigo = $_POST['codigo'];
$textcodigo = $_POST['textopago'];
$valor = $_POST['valor'];
$refer = strtoupper($_POST['refer']);
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
$perfilFac = $_POST['perfilFac'];
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

if ($perfilFac == 1) {
    $numfactura = $hotel->getNumeroFactura(); // Numero Actual del Abono
    $nuevonumero = $hotel->updateNumeroFactura($numfactura + 1); // Actualiza Consecutivo del Abono
} else {
    $numfactura = $hotel->getNumeroAbono(); // Numero Actual del Abono
    // echo 'Numero Abono '.$numfactura;
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
        $fechaVen = date('Y-m-j', $fechaVen);
    }
    // $datosCentroCia = $hotel->getTraeCentroCia($idcentro);
}

$nroFactura = $numfactura;
$idperfil = $id;

$inserta = $hotel->insertFacturaHuesped($codigo, $textcodigo, $valor, $refer, $numero, $room, $idhues, $folio, $canti, $usuario, $idUsuario, $fecha, $numfactura, $tipofac, $id, $idcentro, $prefijo, $perfilFac, $detallePag);

$factu = $hotel->updateCargosReservaFolio($numero, $numfactura, $folio, $fecha, $usuario, $idUsuario, $tipofac, $id);

$saldos = $hotel->getValorFactura($numfactura);
$anticipos = $hotel->valorAnticipos($numfactura);

if (count($anticipos) != 0) {
    $paganticipo = $anticipos[0]['pagos'];
}

$updFac = $hotel->updateFactura($idUsuario, $saldos[0]['cargos'], $saldos[0]['imptos'], $saldos[0]['pagos'], $saldos[0]['base'], $paganticipo, $fechaVen, $numfactura, $usuario, $fecha);

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

// echo 'Tipo Factura '.$tipofac;

if ($tipofac == 2) {
    $datosCompania = $hotel->getSeleccionaCompania($idperfil);
    $diasCre = $datosCompania[0]['dias_credito'];
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

// echo 'Perfil Factura '.$perfilFac;

if ($perfilFac == 1) {
    $eFact = [];
    $eCust = [];
    $ePago = [];
    $eLmon = [];
    $eTaxe = [];
    $eInvo = [];

    $eFact['number'] = $nroFactura;
    $eFact['type_document_id'] = $datosHuesped[0]['tipo_identifica'];
    $eFact['date'] = $fechaFac;
    $eFact['time'] = $horaFact;
    $eFact['resolution_number'] = $resolucion;
    $eFact['prefix'] = $prefijo;
    $eFact['notes'] = $detallePag;
    $eFact['disable_confirmation_text'] = true;
    $eFact['sendmail'] = true;
    $eFact['sendmailtome'] = true;
    $eFact['head_note'] = 'PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN';
    $eFact['foot_note'] = 'PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL PIE DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN';

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

    $ePago['payment_form_id'] = $codigo;
    $ePago['payment_method_id'] = $codigo;
    $ePago['payment_due_date'] = $fechaVen;
    $ePago['duration_measure'] = $diasCre;

    $eLmon['line_extension_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_exclusive_amount'] = $subtotales[0]['cargos'];
    $eLmon['tax_inclusive_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];
    $eLmon['allowance_total_amount'] = 0;
    $eLmon['payable_amount'] = $subtotales[0]['cargos'] + $subtotales[0]['imptos'];

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

    $eFact['customer'] = $eCust;
    $eFact['payment_form'] = $ePago;
    $eFact['legal_monetary_totals'] = $eLmon;
    $eFact['tax_totals'] = $eTaxe;
    $eFact['invoice_lines'] = $eInvo;

    $eFact = json_encode($eFact);

    include_once '../../api/Crea_Factura.php';

    // Actualizar la factura con el response de la plataforma !!!
    // echo $response;
    // utilizar variable inserta [Numero de registro de la factura]

    include_once '../../imprimir/imprimeFactura.php';
} else {
    // echo 'Entro Imprimir Abono ';

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
    $salida = $hotel->updateReservaHuespedSalida($numero, $usuario, $idUsuario, FECHA_PMS);
    $habSucia = $hotel->updateEstadoHabitacion($room);
    array_push($estadofactura, '0');
}

echo json_encode($estadofactura);
