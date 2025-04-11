<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$dele = $admin->eliminaTipoPlato($id) ;

	echo $dele ;

 ?>
