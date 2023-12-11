<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['idAgrpMod'];
	$descripcion = strtoupper(addslashes($_POST['descripcionMod']));
	$ambi        = strtoupper(addslashes($_POST['nombreAmbiMod']));

	$update = $admin->updateTipoPlato($ambi, $descripcion, $id) ;

	echo $update ;

 ?>
