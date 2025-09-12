<?php

require '../../../../res/php/app_topPos.php';

$usu = $_POST['user'];
$amb = $_POST['idamb'];
$nomamb = $_POST['nomamb'];
$fecha = $_POST['fecha'];
$comanda = $_POST['comanda'];
$productos = $_POST['nuevosprod'];
$subtotal = 0;
$imptos = 0;
$total = 0;
$impt = 0;

foreach ($productos as $prod) {
    $subt = round($prod['venta'], 2);
    $impt = $prod['valorimpto'];
    $ingresa = $pos->ingresoProductosComanda($amb, $usu, $prod['producto'], $subt, $prod['cant'], $prod['importe'], $prod['codigo'], $comanda, $prod['impto'], $impt);
    $subtotal = $subtotal + $subt;
    $imptos = $imptos + $impt;
    $total = $total + ($subt + $impt);
}

$aplicades = $pos->updateValorComanda($comanda, $amb, $subtotal, $imptos, $total);

/* $_SESSION['NUMERO_COMANDA'] = $comanda;
$_SESSION['AMBIENTE_ID'] = $amb;
$_SESSION['NOMBRE_AMBIENTE'] = $nomamb;
$_SESSION['usuario'] = $usu; */

echo $comanda;
