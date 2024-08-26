<?php 

  require '../../../res/php/app_topInventario.php'; 

	$codigo = $_POST['codigo'];

	$unidad = $inven->getBuscaUnidadCompra($codigo); 

	echo $unidad;
?>
