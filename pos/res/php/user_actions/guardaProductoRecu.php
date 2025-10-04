<?php
	  // require '../../../../res/php/titles.php';
	  require '../../../../res/php/app_topPos.php'; 
	  
	
		$producto = strtoupper(strip_tags($_POST["producto"]));
		$seccion  = strtoupper(strip_tags($_POST["seccion"]));
		$venta    = strip_tags($_POST["venta"]);
		$impto    = strtoupper(strip_tags($_POST["impto"]));
		$tipo     = strtolower(strip_tags($_POST["tipo"]));
		$idamb    = $_SESSION['AMBIENTE_ID'];
			
		$crea = $pos->adicionaProducto($producto,$seccion,$venta,$impto,$tipo,$idamb);

		echo $crea;

?>	