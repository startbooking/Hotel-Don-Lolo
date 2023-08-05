<?php 
	
  require '../../../res/php/app_topAdmin.php'; 

	$id = $_POST['id'];

	$eliminaAgrupacion = $admin->eliminaAgrupacion($id) ;

	echo $eliminaAgrupacion ;

 ?>
