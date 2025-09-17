<?php

require '../../../../res/php/app_topPos.php';
extract($_POST);
$subtotal = 0;
$imptos = 0;
$total = 0;
$impt = 0; 

foreach ($nuevosprod as $prod) {
    $subt = round($prod['venta'], 2);
    $impt = $prod['valorimpto'];
    $ingresa = $pos->ingresoProductosComanda($id_ambiente, $usuario, $prod['producto'], $subt, $prod['cant'], $prod['importe'], $prod['codigo'], $comanda, $prod['impto'], $impt);
    $subtotal = $subtotal + $subt;
    $imptos = $imptos + $impt;
    $total = $total + ($subt + $impt);
}

$aplicades = $pos->updateValorComanda($comanda, $id_ambiente, $subtotal, $imptos, $total);

echo $comanda;
