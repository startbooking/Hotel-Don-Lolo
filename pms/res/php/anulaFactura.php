<?php

require '../../../res/php/titles.php';
require '../../../res/php/app_topHotel.php';

$numero = $_POST['numero'];
$motivo = strtoupper($_POST['motivo']);
$reserva = $_POST['reserva'];
$usuario = $_POST['usuario'];
$idusuario = $_POST['idusuario'];

// echo $numero;

$resFac = $hotel->getResolucion();

$resolucion = $refFac[0]['resolucion'];
$prefijo = $refFac[0]['prefijo'];
$fechaRes = $refFac[0]['fecha'];
$desde = $refFac[0]['desde'];
$hasta = $refFac[0]['hasta'];

$dFactura = $hotel->infoFactura($numero);

echo print_r($dFactura);

$eNote = [];
$eBill = [];

/* $eBill['number'];
$eBill['uuid'];
$eBill['issue_date']; */

$eNote['billing_reference'] = $eBill;

/*
include_once '../../api/Nota_credito.php';

include_once '../../imprimir/imprimeFacturaAnulada.php';

$cargos = $hotel->actualizaCargosFacturas($numero);
$anula = $hotel->anulaFactura($numero, $motivo, $usuario, $idusuario);
$entra = $hotel->updateEstadoReserva($reserva);
 */
echo $entra;
