<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['idCentroMod'];
	$descripcion = strtoupper(addslashes($_POST['nombreMod']));
	$depto       = $_POST['deptoMod'];
	$costo       = $_POST['costoMod'];
	$gasto       = $_POST['gastoMod'];

	$updateCentro = $admin->updateCentro($descripcion, $depto, $costo, $gasto, $id) ;

	echo $updateCentro ;

 ?>
