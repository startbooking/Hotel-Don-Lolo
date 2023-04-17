<?php 
  
  require '../../../res/php/app_topAdmin.php'; 
 
	$id          = $_POST['idFormaPagoMod'];
	$descripcion = strtoupper(addslashes($_POST['nombreMod']));
	$puc         = $_POST['pucMod'];
	$contabil    = strtoupper(addslashes($_POST['descripcionMod']));

	$actualFormaPago = $admin->updateFormaPago($descripcion, $puc, $contabil, $id) ;

	echo $actualFormaPago ;

 ?>
