<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$regis = $admin->eliminaImpuesto($id) ;

	echo $regis ;

 ?>
