<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaImpto = $admin->eliminaImpuesto($id) ;

	echo $eliminaImpto ;

 ?>
