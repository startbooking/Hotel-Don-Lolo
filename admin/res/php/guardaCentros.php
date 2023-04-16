<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['nombreAdi']));
	$depto = $_POST['deptoAdi'];
	$costo = $_POST['costoAdi'];
	$gasto = $_POST['gastoAdi'];

	$guardaCentro = $admin->insertCentro($descripcion, $depto, $costo, $gasto) ;

	echo $guardaCentro ;

 ?>
