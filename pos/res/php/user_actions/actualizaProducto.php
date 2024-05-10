<?php
	  require '../../../../res/php/titles.php';
	  require '../../../../res/php/app_topPos.php'; 
	
		$id       = $_POST["idProd"];
		$producto = strtoupper(strip_tags($_POST["producto"]));
		$codigo   = strtoupper(strip_tags($_POST["codigo"]));
		$seccion  = strtoupper(strip_tags($_POST["seccion"]));
		$venta    = strip_tags($_POST["venta"]);
		$impto    = strtoupper(strip_tags($_POST["impto"]));
		$tipo     = strtolower(strip_tags($_POST["tipo"]));

		if($tipo==0){
			$receta = 0;
		}else{
			$receta   = $_POST["idrecetaUpd"]; 
		}
			
		$upda = $pos->actualizaProducto($id, $producto, $codigo, $seccion, $venta, $impto, $tipo, $receta);

		echo $upda;

?>	