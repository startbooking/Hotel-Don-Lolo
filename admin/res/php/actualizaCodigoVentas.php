<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['idCodigoMod'];
	$descripcion = strtoupper(addslashes($_POST['nombreMod'])); 
	$impto       = $_POST['imptosMod'];
	$grupo       = $_POST['grupoMod'];
	$puc         = $_POST['pucMod'];
	$centro      = $_POST['centroMod'];
	$contabil    = strtoupper(addslashes($_POST['descripcionMod']));

	$updateCodigo = $admin->updateCodigoVenta($descripcion, $impto, $grupo, $puc, $contabil, $id, $centro) ;

	echo $updateCodigo ;

 ?>
