<?php

require '../../../../res/php/app_topPos.php';

$comanda = $_POST['comanda'];
$motivo = strtoupper($_POST['motivo']);
$user = $_POST['user'];
$idamb = $_POST['idambi'];
$idprod = $_POST['idprod'];
$importe = $_POST['importe'];
$impto = $_POST['impto'];

$fecha = $_POST['fecha'];
$inicial = $_POST['inicial'];
$devuelve = $_POST['cantidad'];
$estado = 0;
$cantidad = 0;
$cantidad = $inicial - $devuelve;
$valventa = $cantidad * $importe;

if ($inicial == $devuelve) {
    $estado = 1;
}
$devol = $pos->devolucionParcialProducto($comanda, $devuelve, $cantidad, $idprod, $valventa, $motivo, $user, $idamb, $fecha, $estado);

$saldos = $pos->getProductosEstadoCuenta($idamb, $comanda);

$subtotal = 0;
$imptos = 0;
$total = 0;

foreach ($saldos as $comandaventa) {
    $subt = round($comandaventa['venta'], 0);
    $impt = $comandaventa['valorimpto'];
    $subtotal = $subtotal + $subt;
    $imptos = $imptos + $impt;
    $total = $total + ($subt + $impt);
}

$aplicades = $pos->updateValorComanda($comanda, $idamb, $subtotal, $imptos, $total);

echo $devol;
