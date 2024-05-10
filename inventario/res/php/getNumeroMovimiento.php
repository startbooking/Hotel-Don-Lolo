<?php 

  require '../../../res/php/app_topInventario.php'; 

	$tipo = $_POST['tipo'];

	$numeroMov = $inven->getNumeroMovimientoInventario($tipo); 
	$increment = $inven->incrementaNumeroMovimientoInv($tipo,$numeroMov+1);

	$_SESSION['numeroEntrada'] = $numeroMov;

	 
	echo trim($numeroMov); 


?>
