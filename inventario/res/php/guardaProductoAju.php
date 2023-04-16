<?php

	require '../../../res/php/app_topInventario.php'; 

	$usuario         = $_POST['usuario'];
	$fechaing        = date('Y-m-d h:m:s');
	$tipo            = $_POST['tipo'];
	$tipomovi        = $_POST['tipomovi'];
	$movimi          = $_POST['movimi'];
	$almacen         = $_POST['almacen'];
	$numeroMov       = $_POST['numeroMov'];
	$ajustes         = $_POST['ajustes'];
	$fecham          = $_POST['fecha'];

	foreach ($ajustes as $ajuste) {
		$producto        = $ajuste['producto'];
		$codigo          = $ajuste['codigo'];
		$subtotal        = $ajuste['subtotal'];
		$unit            = $ajuste['unit'];
		$desunid         = $ajuste['desunid'];
		$total           = $ajuste['total'];
		$unidad          = $ajuste['unidad'];
		$unidadalm       = $ajuste['unidadalm'];
		$cantidad        = $ajuste['cantidad'];
		$costo           = $ajuste['costo'];

		$insertMovi = $inven->insertaMovimientoAju($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, $almacen, 1, $usuario);

	}

	include_once '../../views/prints/imprimeAjuste.php';

?>