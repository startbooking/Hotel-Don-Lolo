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
$idUsuario = $_POST['idusuario'];
$reserva = $numero;
$nroFolio = $folio;
$idhuesped = $idhues;
$diasCre = 0;

$horaFact = date('H:s:i');

// echo $horaFact;

$datosHuesped = $hotel->getbuscaDatosHuesped($idhuesped);
$resFac = $hotel->getResolucion();


$fechaFac = FECHA_PMS;
$fechaVen = $fechaFac;
$diasCre = 0;
$paganticipo = 0;

$numfactura = $hotel->getNumeroFactura(); // Numero Actual del Abono
$nuevonumero = $hotel->updateNumeroFactura($numfactura + 1); // Actualiza Consecutivo del Abono

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

$inserta = $hotel->insertFacturaHuesped($codigo, $textcodigo, $valor, $refer, $numero, $room, $idhues, $folio, $canti, $usuario, $idUsuario, $fecha, $numfactura, $tipofac, $id, $idcentro);

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

// include_once '../../api/Crea_Factura.php';

$eFact = [];

/* array_push($encabezadoFactura, {name:'number',value:$nroFactura});

array_push($encabezadoFactura, ) */
// { name: "usuario", value: usuario }

$eFact['number'] = $nroFactura;
$eFact['type_document_id'] = $datosHuesped[0]['tipo_identifica'];
$eFact['date'] = $fechaFac;
$eFact['time'] = $horaFact;
$eFact['resolution_number'] = 
"": "18764040460991",
	"prefix": "ELP",
  "notes": "ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA",
  "disable_confirmation_text": true,
	"sendmail": true,
	"sendmailtome": true,
	"head_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
	"foot_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL PIE DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",


/* echo print_r($eFact);
echo 'Seis  ';

echo json_encode($eFact);

var_dump($eFact);

echo 'PAso por Aca ';
 */
/* "number": 63677,
"type_document_id": 1,
"date": "2022-12-07",
"time": "04:08:12",
"resolution_number": "18764040460991",
"prefix": "ELP",
"notes": "ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA, ESTA ES UNA NOTA DE PRUEBA",
"disable_confirmation_text": true,
"sendmail": true,
"sendmailtome": true,
"head_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL ENCABEZADO DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN",
"foot_note": "PRUEBA DE TEXTO LIBRE QUE DEBE POSICIONARSE EN EL PIE DE PAGINA DE LA REPRESENTACION GRAFICA DE LA FACTURA ELECTRONICA VALIDACION PREVIA DIAN", */

// / include_once '../../imprimir/imprimeFactura.php';

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
} else { */
/* Verificar Saldo en la cuenta de esa habitacion */
/* $salida = $hotel->updateReservaHuespedSalida($numero, $usuario, $idUsuario, FECHA_PMS);
$habSucia = $hotel->updateEstadoHabitacion($room);
array_push($estadofactura, '0');
}

echo json_encode($estadofactura); */
