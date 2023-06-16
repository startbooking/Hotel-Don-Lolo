<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaFormaPago = $admin->eliminaFormaPago($id) ;

	echo $eliminaFormaPago ;

 ?>
