<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaDepto = $admin->eliminaFamilia($id) ;

	echo $eliminaDepto ;

 ?>
