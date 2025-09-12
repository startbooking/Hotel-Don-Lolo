<?php
require '../../../../res/php/titles.php';
require '../../../../res/php/app_topPos.php';

extract($_POST);

if ($tipo == 0) {
	$receta = 0;
} else {
	$receta   = $idrecetaUpd;
}
$upda = $pos->actualizaProducto($idProd, strtoupper($producto), strtoupper($codigo), $seccion, $venta, $impto, $tipo, $receta, $unidadMedUpd);

echo $upda;
