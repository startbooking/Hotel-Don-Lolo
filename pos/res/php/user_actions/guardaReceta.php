<?php
require '../../../../res/php/app_topPos.php';
extract($_POST);

if (isset($_POST['subreceta'])) {
    $subreceta = 1;
} else {
    $subreceta = 0;
}

$porImp = $pos->traePorcentajeImpto($impto);

$vlrNeto = round($vlrVenta / (1 + ($porImp / 100)), 2);
$vlrImpt = (($vlrNeto * $porImp) / 100);
$vlrPorc = $vlrNeto / $porcion;

$adiProducto = $pos->adicionaReceta(strtoupper($receta), $porcion, $tipoReceta, $impto, $subreceta, $vlrVenta, $vlrNeto, $vlrImpt, $vlrPorc, $margen, $tiempo, strtoupper($preparacion), strtoupper($montaje), $usuario);

echo $adiProducto;
