<?php

	require '../../../res/php/app_topInventario.php'; 

	$idusr     = $_POST['idusr'];
	$user      = $_POST['user'];
	$numero    = $_POST['numero'];
	$proveedor = $_POST['centro'];
	$almacen   = $_POST['almacen'];
	$fecha     = $_POST['fecha'];
	$recetas   = $_POST['recetas'];

	$numeroPed = $numero;
	
	$productos = [];

	foreach ($recetas as $key => $receta) {
		$receProd = $inven->getProductosRecetas($receta['codigo'],$receta['cantidad'],$receta['porciones']);
		$productos = array_merge($productos,$receProd);
	}

	foreach ($productos as $key => $producto) {
	
		$codigo    = $producto['id_producto'];
		$existe    = $inven->buscaProductoRecetaReq($numero,$codigo);
		$cantidad  = ($producto['cantidad']*$producto['cantPedida'])/$producto['valor_conversion'];
		$costo     = $producto['valor_costo'];
		$total     = ($costo*$cantidad)*$producto['valor_conversion'];

		if($existe){ 
			$canti  = $existe[0]['cantidad'];
			$val    = $existe[0]['valor_unitario']; 
			$nuecan = $canti + $cantidad;
			$valcant= $nuecan * $val ; 			
			$upd = $inven->updatePedido($numero, $codigo, $nuecan, $valcant);
		}else{
			$unidadcom = $producto['unidad_almacena'];
			$inserta = $inven->insertaPedido($numero, $almacen, $proveedor, $fecha, $cantidad, $codigo, $costo, $total, $unidadcom, $user);
		}

	}

	include_once '../../views/prints/imprimePedido.php';


?>