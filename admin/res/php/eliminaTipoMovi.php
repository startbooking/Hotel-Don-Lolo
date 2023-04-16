<?php 
	
  require '../../../res/php/app_topAdmin.php'; 


	$id     = $_POST['id'];

	$borra = $admin->eliminaTipoMovi($id);
	
	echo $borra ;
	
 ?>
