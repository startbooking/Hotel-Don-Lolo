<?php

require '../../../../res/php/app_topPos.php';

$comanda = $_POST['comanda'];
$motivo = strtoupper($_POST['motivo']);
$user = $_POST['usuario'];
$idamb = $_POST['idambi'];
$idprod = $_POST['idprod'];
$importe = $_POST['importe'];
$impto = $_POST['impto'];
$impuesto = $_POST['impuesto'];

$fecha = $_POST['fecha_auditoria'];
$inicial = $_POST['inicial'];
$devuelve = $_POST['cantidad'];
$estado = 0;
$cantidad = 0;
$cantidad = $inicial - $devuelve;

$baseVta = round($cantidad * $importe,2);
$montoimpto = round($baseVta * $impto,2);

if($impuesto==1){
    $baseVta =  round(($cantidad * $importe) / (1+($impto/100)),2);
    $montoimpto = round(($cantidad * $importe)- $baseVta,2);
}

if ($inicial == $devuelve) {
    $estado = 1;
}
$devol = $pos->devolucionParcialProducto($comanda, $devuelve, $cantidad, $idprod, $baseVta, $montoimpto, $motivo, $user, $idamb, $fecha, $estado);

$saldos = $pos->getProductosEstadoCuenta($idamb, $comanda);

$subtotal = 0;
$imptos = 0;
$total = 0;

foreach ($saldos as $comandaventa) {
    $subt = round($comandaventa['venta'], 2);
    $impt = $comandaventa['valorimpto'];
    $subtotal = $subtotal + $subt;
    $imptos = $imptos + $impt;
    $total = $total + ($subt + $impt);
}

$aplicades = $pos->updateValorComanda($comanda, $idamb, $subtotal, $imptos, $total);

echo $devol;
