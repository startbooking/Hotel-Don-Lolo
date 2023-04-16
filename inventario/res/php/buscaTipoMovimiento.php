<?php 

  require '../../../res/php/app_topInventario.php'; 

	$codigo = $_POST['movi'];

	$tipoMov = $inven->getBuscaTipoMovimiento($codigo); 
	echo $tipoMov;
?>
