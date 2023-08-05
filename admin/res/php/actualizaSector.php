<?php 
  
  require '../../../res/php/app_topAdmin.php'; 

	$id          = $_POST['id'];
	$descripcion = strtoupper(addslashes($_POST['sector']));

	$actualSector = $admin->updateSector($descripcion, $id) ;

	echo $actuaSector ;

 ?>
