<?php
	  require '../../../../res/php/app_topPos.php';  

		$producto = strtoupper(strip_tags($_POST["producto"]));
		$codigo   = strtoupper(strip_tags($_POST["codigo"]));
		$seccion  = strtoupper(strip_tags($_POST["seccion"]));
		$venta    = strip_tags($_POST["venta"]);
		$impto    = strtoupper(strip_tags($_POST["impto"]));
		$tipo     = strtolower(strip_tags($_POST["tipo"]));
		if($tipo==0 || !isset($tipo)){
			$receta = 0;
		}else{
			$receta   = $_POST["idrecetaAdi"];
		}

		$idamb    = $_POST["idamb"];
		$crea = $pos->adicionaProducto($producto, $codigo, $seccion, $venta, $impto, $tipo, $receta, $idamb);

		echo $crea;

?>