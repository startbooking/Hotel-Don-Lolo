<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['idAgrpMod'];
	$descripcion = strtoupper(addslashes($_POST['descripcionMod']));

	$updateAgrupa = $admin->updateAgrupacion($descripcion, $id) ;

	echo $updateAgrupa ;

 ?>
