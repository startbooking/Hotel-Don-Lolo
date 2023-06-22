<?php 

  require '../../../../res/php/app_topPos.php'; 

	$bodega  = $_POST['bodega'];
	$producto  = $_POST['producto'];
	$kardexs = $pos->getTraeKardexProducto($producto, $bodega); 

	echo json_encode($kardexs);

?>
