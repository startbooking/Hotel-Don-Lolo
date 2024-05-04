<?php 

  require '../../../res/php/app_topInventario.php'; 

	$codigo = $_POST['impto'];

	$porcen = $admin->getPorcentajeImpto($codigo); 
	echo $porcen;
?>
