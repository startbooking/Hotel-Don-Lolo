<?php

	require '../../../res/php/app_topInventario.php';
	extract($_POST);
	$fechaing        = date('Y-m-d h:m:s');
	foreach ($productos as $ajuste) {
		$producto        = $ajuste['producto'];
		// $codigo          = $ajuste['codigo'];
		$subtotal        = $ajuste['subtotal'];
		$unit            = $ajuste['unit'];
		// $desunid         = $ajuste['desunid'];
		$total           = $ajuste['total'];
		$unidad          = $ajuste['unidad'];
		$unidadalm       = $ajuste['unidadalm'];
		$cantidad        = $ajuste['cantidad'];
		// $costo           = $ajuste['costo'];

		$insertMovi = $inven->insertaMovimientoAju($tipomov, $tipo, $movimiento, $numero, $fecha, $fechaing, $ajuste['producto'], $ajuste['cantidad'], $ajuste['unidadalm'], $ajuste['unit'], $ajuste['subtotal'], $ajuste['total'], $almacen, 1, $usuario);

	}

	include_once '../../views/prints/imprimeAjuste.php';

?>