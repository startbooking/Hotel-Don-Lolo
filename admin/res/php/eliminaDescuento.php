<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id  = $_POST['idDescuentoEli'];

	$regis = $admin->eliminaDescuento($id) ;

	echo $regis ;

 ?>
