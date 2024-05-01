<?php

	require '../../../res/php/app_topInventario.php'; 


	/*

	$numeroMov   = $_POST['numeroMov'];

	$fechaing    = date('Y-m-d h:m:s');
	$usuario     = $_POST['usuario'];

	foreach ($movimientos as $movimiento) {
		$almacen         = $movimiento['almacen'];
		$movimi          = $movimiento['movimi'];
		$tipomovi        = $movimiento['tipomovi'];
		$provee          = $movimiento['provee'];
		$fecham          = $movimiento['fecham'];
		$factur          = $movimiento['factur'];
		$impto           = $movimiento['impto'];
		$desimpto        = $movimiento['desimpto'];
		$porcentajeImpto = $movimiento['porcentajeImpto'];
		$impuesto        = $movimiento['impuesto'];
		$incluido        = $movimiento['incluido'];
		$codigo          = $movimiento['codigo'];
		$descripcion     = $movimiento['descripcion'];
		$subtotal        = $movimiento['subtotal'];
		$unit            = $movimiento['unit'];
		$desunid         = $movimiento['desunid'];
		$total           = $movimiento['total'];
		$producto        = $movimiento['producto'];
		$unidad          = $movimiento['unidad'];
		$unidadalm       = $movimiento['unidadalm'];
		$cantidad        = $movimiento['cantidad'];
		$costo           = $movimiento['costo'];
		$insertMovi = $inven->insertaMovimiento($tipomovi, $tipo, $movimi, $numeroMov, $fecham, $fechaing, $provee, $factur, $producto, $cantidad, $unidadalm, $unit, $subtotal, $total, $porcentajeImpto, $impuesto, $impto, $almacen, 1, $usuario);
		$tipoAlm = $inven->getAlmacenPrincipal($almacen);
		*/
		/*
		if($tipo=='1' && $tipoAlm=='1'){
			$prom = $inven->calculaPromedioProd($producto,$almacen);
			$inven->actualizaValorProd($producto, $prom[0]['entradas'], $prom[0]['salidas'], $prom[0]['saldo'], $prom[0]['valorentradas'], $prom[0]['valorsalidas'], $prom[0]['valorsaldo'], $prom[0]['promedio']);
		}
	}
	include_once '../../views/prints/imprimeEntradas.php';
	*/

?>