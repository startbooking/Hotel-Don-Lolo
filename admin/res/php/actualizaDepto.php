<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['id'];
	$descripcion = strtoupper(addslashes($_POST['depto']));

	$actualDepto = $admin->updateDepto($descripcion, $id) ;

	echo $actualDepto ;

 ?>
