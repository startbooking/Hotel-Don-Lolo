<?php 

  require '../../../res/php/app_topInventario.php';
	extract($_POST);

	$numero = $inven->getNumeroMovimientoInventario($tipo); 
	$increment = $inven->incrementaNumeroMovimientoInv($tipo,$numero+1);

	echo $numero;


?>
