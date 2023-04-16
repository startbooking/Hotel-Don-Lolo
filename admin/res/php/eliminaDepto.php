<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaDepto = $admin->eliminaDepto($id) ;

	echo $eliminaDepto ;

 ?>
