<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$descripcion = strtoupper(addslashes($_POST['depto']));

	$guardaDepto = $admin->insertDepto($descripcion) ;

	echo $guardaDepto ;

 ?>
